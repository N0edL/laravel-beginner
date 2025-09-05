<body style="margin:0; padding:0; background:#000000; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background:#000000;">
        <tr>
            <td align="center" style="padding:40px 20px;">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="500"
                    style="background:#0e0e0e; border-radius:24px; border:1px solid #333; overflow:hidden;">
                    <!-- Header -->
                    <tr>
                        <td align="center" style="padding:40px 30px 30px; background:#111;">
                            <h1 style="color:#ffffff; margin-bottom:5px; font-size: 1.8rem; line-height: 1.5rem; font-weight: 500; letter-spacing: -0.5px;">NoedL<span style="opacity:0.7; line-height: 1.5rem; font-weight: 500; letter-spacing: -0.5px;">.xyz</span></h1>
                            <p style="margin:8px 0 0; font-size:14px; color:#aaa;">
                                Portfolio</p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td align="center" style="padding:30px;">
                            <h2 style="font-size:24px; font-weight:600; margin:0 0 12px; color:#ffffff;">Thanks {{
                                $data['name'] ?? 'N/A' }}! ✨</h2>
                            <p style="margin:0 0 30px; font-size:16px; line-height:1.5; color:#eee;">
                                Your message has been received at
                                <span style="color:#fff2aa; font-weight:300;">
                                    {{ $data['created_at'] ?? 'N/A' }}
                                </span>.
                                I'll get back to you within 24-48 hours.
                            </p>

                            <!-- Info Card -->
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
                                style="background:#ffffff08; border-radius:16px; border:1px solid #444;">
                                <tr>
                                    <td style="padding:20px; text-align:left;">
                                        <p style="margin:0 0 8px; font-size:14px; font-weight:600; color:#ffffff;">Your
                                            Message</p>
                                        <p style="margin:0; font-size:14px; line-height:1.4; color:#ccc;">
                                            {!! nl2br(e($data['message'] ?? '')) !!}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center"
                            style="padding:20px; border-top:1px solid #333;">
                            <p style="margin:0; font-size:12px; color:#aaa;">
                                © {{ date('Y') }} NoedL.xyz. All rights reserved.
                            </p>
                            <p style="margin:4px 0 0; font-size:12px; color:#aaa;">
                                This is an automated message. Please do not reply to this email.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
