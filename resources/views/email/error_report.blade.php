<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Error Report</title>
</head>

<body>
    <h2>An error occurred in the application</h2>
    <p><strong>URL:</strong> {{ $url }}</p>
    <p><strong>Message:</strong> {{ $error_message }}</p> <!-- Renamed to error_message -->
    <h4>Trace:</h4>
    <pre>{{ $trace }}</pre>
</body>

</html>