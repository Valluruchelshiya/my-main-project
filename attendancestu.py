from flask import Flask, request, render_template
from flask_mysqldb import MySQL
from flask_cors import CORS

app = Flask(__name__)  # ✅ fixed
CORS(app)

# MySQL Config
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'register'

mysql = MySQL(app)

@app.route('/uploadAttendancePage', methods=['GET'])
def uploadAttendancePage():
    cur = mysql.connection.cursor()
    cur.execute("SELECT roll_no, username FROM registerform")
    students = cur.fetchall()
    cur.close()

    subjects = ['Math', 'Science', 'English']
    return render_template("attendanceadmin.html", students=students, subjects=subjects)

@app.route('/uploadAttendance', methods=['POST'])
def uploadAttendance():
    formData = request.form
    attendanceData = []

    for key, status in formData.items():
        rollNo, subject = key.split('-')
        attendanceData.append((rollNo, subject, status))

    cur = mysql.connection.cursor()
    for record in attendanceData:
        cur.execute("INSERT INTO attendance (roll_no, subject, status) VALUES (%s, %s, %s)", record)
    mysql.connection.commit()
    cur.close()

    cur = mysql.connection.cursor()
    cur.execute("SELECT roll_no, username FROM registerform")
    students = cur.fetchall()
    cur.close()

    subjects = ['Math', 'Science', 'English']
    return render_template("attendanceadmin.html", students=students, subjects=subjects)

@app.route('/attendancestu')
def attendancestu():
    rollNo = request.args.get('rollNo')
    if not rollNo:
        return "Roll number is required", 400

    cur = mysql.connection.cursor()
    subjects = ['Math', 'Science', 'English']

    presentCounts = []
    absentCounts = []

    for subject in subjects:
        cur.execute("SELECT COUNT(*) FROM attendance WHERE roll_no = %s AND subject = %s AND status = 'Present'", (rollNo, subject))
        presentCount = cur.fetchone()[0]

        cur.execute("SELECT COUNT(*) FROM attendance WHERE roll_no = %s AND subject = %s AND status = 'Absent'", (rollNo, subject))
        absentCount = cur.fetchone()[0]

        presentCounts.append(presentCount)
        absentCounts.append(absentCount)

    cur.close()

    return render_template("attendancestu.html",
                           roll_no=rollNo,
                           subjects=subjects,
                           present_counts=presentCounts,
                           absent_counts=absentCounts)

@app.route('/some')
def some_func():
    curr = mysql.connection.cursor()
    return "Server is running!"

if __name__ == '__main__':  # ✅ fixed
    app.run(debug=True)