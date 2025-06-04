document.getElementById('attendanceForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData();
  
    formData.append('student_id', document.getElementById('student_id').value);
    formData.append('subject', document.getElementById('subject').value);
    formData.append('date', document.getElementById('date').value);
    formData.append('status', document.getElementById('status').value);
  
    fetch('http://localhost:5000/upload_attendance', {
      method: 'POST',
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        document.getElementById('message').innerText = data.message || 'Attendance uploaded!';
      })
      .catch(err => {
        document.getElementById('message').innerText = 'Error uploading attendance.';
        console.error(err);
      });
  });
  
  function loadAttendance() {
    const studentId = document.getElementById('search_student_id').value;
    fetch(`http://localhost:5000/get_attendance/${studentId}`)
      .then(res => res.json())
      .then(data => {
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        const subjects = data.map(item => item.subject);
        const percentages = data.map(item => item.percentage);
  
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: subjects,
            datasets: [{
              label: 'Attendance (%)',
              data: percentages,
              backgroundColor: 'rgba(75, 192, 192, 0.6)'
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
                max: 100
              }
            }
          }
        });
      });
  }
  