<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            padding: 20px;
        }
        .section-header {
            background-color: #f3f4f6;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            font-size: 1.125rem;
            font-weight: 600;
            color: #4b5563;
        }
        .section-content {
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .section-content p {
            margin: 0;
            color: #6b7280;
            font-family: 'Inter', sans-serif;
        }
        .section-content ul {
            list-style-type: none;
            padding-left: 0;
            font-family: 'Inter', sans-serif;
        }
        .section-content li {
            margin: 5px 0;
            font-family: 'Inter', sans-serif;
        }
        .header {
            font-size: 2rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 25px;
            color: #1f2937;
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body>

    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
        <h1 class="header">Meeting Details</h1>

        <div class="section-content">
            <div class="section-header">Meeting Information</div>
            <div>
                <strong>Title:</strong>
                <p>{{ $title }}</p>
            </div>
            <div>
                <strong>Agenda:</strong>
                <p>{{ $agenda }}</p>
            </div>
            <div>
                <strong>Location:</strong>
                <p>{{ $location }}</p>
            </div>
            <div>
                <strong>Date:</strong>
                <p>{{ $date }}</p>
            </div>
            <div>
                <strong>Time:</strong>
                <p>{{ $time }}</p>
            </div>
        </div>

        <div class="section-content">
            <div class="section-header">Attendees</div>
            <p>{{ implode(', ', $attendees) }}</p>
        </div>

        <div class="section-content">
            <div class="section-header">Notes</div>
            <p>{{ $notes }}</p>
        </div>

        <div class="section-content">
            <div class="section-header">Approvals</div>
            <p>{{ implode(', ', $approvals) }}</p>
        </div>
    </div>

</body>
</html>
