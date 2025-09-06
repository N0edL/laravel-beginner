<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="dark light">
    <meta name="supported-color-schemes" content="dark light">
</head>

<body
    style="margin:0; padding:0; background:#000 !important; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="">
        <tr>
            <td align="center" style="padding:40px 20px;">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="500"
                    style="background:#0e0e0e !important; border-radius:24px; border:1px solid #333; overflow:hidden;">
                    <tr>
                        <td align="center" style="padding:40px 30px 30px; background:#111 !important;">
                            <h1
                                style="color:#ffffff !important; margin-bottom:5px; font-size: 1.8rem; line-height: 1.5rem; font-weight: 500; letter-spacing: -0.5px;">
                                NoedL<span
                                    style="opacity:0.7; line-height: 1.5rem; font-weight: 500; letter-spacing: -0.5px;">.xyz</span>
                            </h1>
                            <p style="color:#aaa !important; margin-top:0; margin-bottom:16px; font-weight: 600;">Admin
                                Panel</p>
                            <p
                                style="background:#333 !important; font-size: 12px; font-weight: 600; margin-top:5px; margin-bottom:0px; color:#fff; padding:6px 16px; border-radius:20px; display:inline-block;">
                                NEW MESSAGE</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px; color:#fff !important;">
                            <h2 style="text-align:center;">New Contact 📩</h2>
                            <p style="text-align:center; margin-top:0; margin-bottom:20px; color:#aaa;">You have
                                received a new
                                message via the contact form. Details are below:</p>
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
                                style="margin-bottom:24px;">
                                <tr>
                                    <td style="padding-bottom:16px;">
                                        <div
                                            style="background: #ffffff08 !important; border-radius: 16px; padding: 20px; border: 1px solid #ffffff1a;">
                                            <p
                                                style="color: rgba(255, 255, 255, 0.7) !important; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; margin-top: 0px;">
                                                <b>From</b>
                                            </p>
                                            <p
                                                style="color: #ffffff !important; font-size: 16px; font-weight: 500; margin: 0px;">
                                                {!! nl2br(e($data['name'] ?? 'N/A')) !!}
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom:16px;">
                                        <div
                                            style="background: #ffffff08 !important; border-radius: 16px; padding: 20px; border: 1px solid #ffffff1a;">
                                            <p
                                                style="color: rgba(255, 255, 255, 0.7) !important; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; margin-top: 0px;">
                                                <b>Email</b>
                                            </p>
                                            <p
                                                style="color: #ffffff !important; font-size: 16px; font-weight: 500; margin: 0px;">
                                                {!! nl2br(e($data['email'] ?? 'N/A')) !!}
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div
                                            style="background: #ffffff08 !important; border-radius: 16px; padding: 20px; border: 1px solid #ffffff1a;">
                                            <p
                                                style="color: rgba(255, 255, 255, 0.7) !important; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; margin-top: 0px;">
                                                <b>Date</b>
                                            </p>
                                            <p
                                                style="color: #ffffff !important; font-size: 16px; font-weight: 500; margin: 0px;">
                                                {!! nl2br(e($data['created_at'] ?? 'N/A')) !!}
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <div
                                style="background: #ffffff08 !important; border-radius: 16px; padding: 24px; border: 1px solid #ffffff1a; margin-top:20px;">
                                <p
                                    style="color: #ffffff !important; font-size: 14px; font-weight: 600; margin-bottom: 12px;">
                                    <b>Message</b>
                                </p>
                                <p style="color: #ffffffe6 !important; font-size: 15px; line-height: 1.5;">{!! nl2br(e($data['message'] ?? 'N/A')) !!}</p>
                            </div>

                            <p style="text-align:center; margin-top:20px;">
                                <a href="mailto:{{ $data['email'] ?? '' }}?subject=Re: Your message&body=Hi {{ $data['name'] ?? '' }},%0D%0A%0D%0A"
                                    style="background:#333 !important; color:#fff; text-decoration:none; padding:12px 24px; border-radius:12px; font-weight:bold; display:inline-block;">
                                    Reply Now
                                </a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:20px; color:#aaa; font-size:12px; border-top:1px solid #333;">
                            © {{ date('Y') }} NoedL.xyz. All rights reserved.<br>
                            This is an automated message. Please do not reply.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
