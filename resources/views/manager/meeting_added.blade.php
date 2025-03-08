<!DOCTYPE html>
<html>
<head>
    <title>New Meeting Added</title>
</head>
<body>
    <h1>New Meeting Scheduled</h1>
    <p>Hello!</p>
    <p>A new meeting has been added by {{ $email_manager_name }} from {{ $email_organization_name }}.</p>
    
    <p><strong>Meeting Details:</strong></p>
    <ul>
        <li>Title: {{ $meeting_details['title'] }}</li>
        <li>Location: {{ $meeting_details['location'] }}</li>
        <li>Date: {{ $meeting_details['date'] }}</li>
        <li>Time: {{ $meeting_details['time'] }}</li>
    </ul>

    <p>Thank you!</p>
</body>
</html>
