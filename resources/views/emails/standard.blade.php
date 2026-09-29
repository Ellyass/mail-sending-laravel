<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="margin:0; padding:0; background:#f4f4f5; font-family:Arial, Helvetica, sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f5; padding:24px 0;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; padding:32px; max-width:600px;">
                <tr>
                    <td style="font-size:15px; line-height:1.6; color:#222222;">
                        <p style="margin:0 0 16px;">
                            {{ $recipientName ? 'Merhaba '.$recipientName.',' : 'Merhaba,' }}
                        </p>

                        <div style="margin:0 0 24px;">
                            {!! nl2br(e($body)) !!}
                        </div>

                        <p style="margin:0;">
                            Saygılarımla,<br>
                            <strong>{{ $senderName }}</strong>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
