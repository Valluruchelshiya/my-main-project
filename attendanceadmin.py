from flask import Flask, request, render_template
from flask_mysqldb import MySQL
from flask_cors import CORS

app = Flask(__name__)  # fixed __name_
CORS(app)

# MySQL config
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'register'

mysql = MySQL(app)

# Render Upload Attendance page
@app.route('/upload_attendance_page', methods=['GET'])
def upload_attendance_page():
    # Fetch student data
    cur = mysql.connection.cursor()
    cur.execute("SELECT roll_no, username FROM registerform")
    students = cur.fetchall()
    cur.close()

    # Subject list (can be dynamic too)
    subjects = ['Math', 'Science', 'English']

    return render_template("attendanceadmin.html", students=students, subjects=subjects)

# Handle form submission
@app.route('/upload_attendance', methods=['POST'])
def upload_attendance():
    form_data = request.form
    attendance_data = []

    for student_subject, status in form_data.items():
        student_roll_no, subject = student_subject.split('_')
        attendance_data.append((student_roll_no, subject, status))

    # Store in DB
    cur = mysql.connection.cursor()
    for record in attendance_data:
        cur.execute(
            "INSERT INTO attendance (roll_no, subject, status) VALUES (%s, %s, %s)",
            (record[0], record[1], record[2])
        )
    mysql.connection.commit()
    cur.close()

    # Refetch students and subjects to re-render the page
    cur = mysql.connection.cursor()
    cur.execute("SELECT roll_no, username FROM registerform")
    students = cur.fetchall()
    cur.close()

    subjects = ['Math', 'Science', 'English']
    return render_template("attendanceadmin.html", students=students, subjects=subjects)

if __name__ == '__main__':  # fixed __main_
    app.run(debug=True)