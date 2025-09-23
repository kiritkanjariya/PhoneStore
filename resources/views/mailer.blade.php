<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Demo Mail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="margin: 0; padding: 0; background-color: #eef2f7; font-family: Arial, Helvetica, sans-serif;">

    <table align="center" cellpadding="0" cellspacing="0" width="100%" bgcolor="#eef2f7" style="padding: 40px 0;">
        <tr>
            <td align="center">
                <!-- Main Card -->
                <table cellpadding="0" cellspacing="0" width="600" style="background: #ffffff; border-radius: 16px; box-shadow: 0 6px 18px rgba(0,0,0,0.08); overflow: hidden;">

                    <!-- Header -->
                    <tr>
                        <td align="center" style="background: linear-gradient(135deg, #4CAF50, #2e7d32); padding: 30px;">
                            <h1 style="margin: 0; font-size: 28px; color: #ffffff; letter-spacing: 1px;">Welcome to NextPhone</h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 35px; color: #333; line-height: 1.6;">
                            <h2 style="margin-top: 0; color: #2e7d32; font-size: 22px;">Hello, {{ $name }} </h2>

                            <p style="margin: 15px 0; font-size: 16px; color:#555;">
                                Your <strong>registration is successfully completed</strong>.
                                We’re thrilled to have you with us!
                            </p>

                            <p style="margin: 15px 0; font-size: 16px; color:#555;">
                                Get ready to explore exclusive features and enjoy a seamless experience with <strong>NextPhone</strong>.
                            </p>

                            <hr style="border: none; border-top: 1px solid #eee; margin: 25px 0;">

                            Active Your Account

                            <a href="{{ route('activation',$token) }}">
                                active
                            </a>
                            <p style="font-size: 14px; color: #999; text-align:center;">
                                If you did not sign up, simply ignore this email.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#f7f7f7" style="text-align: center; padding: 25px;">
                            <p style="margin: 0; font-size: 14px; color: #777;">
                                &copy; {{ date('Y') }} <strong>NextPhone</strong>. All rights reserved.
                            </p>
                            <p style="margin: 12px 0 0;">
                                <a href="#" style="margin: 0 8px; text-decoration: none; color: #4CAF50;">🌐</a>
                                <a href="#" style="margin: 0 8px; text-decoration: none; color: #4CAF50;">🐦</a>
                                <a href="#" style="margin: 0 8px; text-decoration: none; color: #4CAF50;">📘</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>