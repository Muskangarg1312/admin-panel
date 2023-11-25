<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Mode Toggle</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <style>
        body {
            transition: background-color 0.3s ease;
        }

        .dark-mode {
            background-color: #333;
            color: #fff;
        }

        .content {
            padding: 20px;
        }

    </style>
</head>
<body>
    <button id="darkModeToggle">Toggle Dark Mode</button>
    <div class="content">
        <h1>Web Page Content</h1>
        <p>This is some sample content.</p>
    </div>
    <!-- <script src="script.js"></script> -->
    <script>
        
        document.getElementById('darkModeToggle').addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('dark-mode', document.body.classList.contains('dark-mode'));
        });

// Check if dark mode was enabled previously
        if (localStorage.getItem('dark-mode') === 'true') {
            document.body.classList.add('dark-mode');
        }

    </script>
</body>
</html>
