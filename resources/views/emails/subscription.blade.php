<!DOCTYPE html>
<html>
<head>
    <title>Subscription Notification</title>
</head>
<body>
    <h2>Hello {{ $subscription->user->name }},</h2>

    <p>{{ $messageContent }}</p>

    <p>Subscription ID: {{ $subscription->id }}</p>
    <p>Status: {{ $subscription->status }}</p>

    <p>Thank you for using our service!</p>
</body>
</html>
