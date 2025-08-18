<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coming Soon</title>
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/style.css')}}" />
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('{{asset("frontend/admin/assets/images/backgrounds/page-header-bg.jpg")}}') no-repeat center center/cover;
            text-align: center;
            color: #fff;
        }
        .coming-soon {
            background: rgba(0, 0, 0, 0.6);
            padding: 40px;
            border-radius: 15px;
        }
        .coming-soon h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .coming-soon p {
            font-size: 1.2rem;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="coming-soon">
        <h1>🚧 Coming Soon 🚧</h1>
        <p>We are working hard to bring something amazing for you.</p>
    </div>
</body>
</html>
