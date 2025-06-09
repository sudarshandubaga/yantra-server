<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>{{ $subject }}</title>
    </head>
    <body>
        <div style="max-width: 800px; margin: auto; border: 1px solid #ccc;">
            <div style="background: #ebebeb; text-align: center; font-size: 48px; padding: 30px 15px;">
                {{ $reciever }}
            </div>
            <div style="padding: 15px">
                Dear Admin,<br>
                <h3>{{ $subject }}</h3>
                <p>Find details as below:</p>
                <table style="border-collapse: collapse; width: 100%;">
                    <tr>
                        <th style="border: 1px solid #ccc; text-align: left;">Name</th>
                        <td style="border: 1px solid #ccc;">{{ $sender }}</td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid #ccc; text-align: left;">Subject</th>
                        <td style="border: 1px solid #ccc;">{{ $form_subject }}</td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid #ccc; text-align: left;">Email</th>
                        <td style="border: 1px solid #ccc;">{{ $from }}</td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid #ccc; text-align: left;">Mobile No.</th>
                        <td style="border: 1px solid #ccc;">{{ $mobile }}</td>
                    </tr>
                    <tr>
                        <th style="border: 1px solid #ccc; text-align: left;">Message</th>
                        <td style="border: 1px solid #ccc;">{{ $msg }}</td>
                    </tr>
                </table>
                <p>&nbsp;</p>
                <p>
                    Thanks &amp; Regards<br>
                    {{ $reciever }} Team
                </p>
            </div>
        </div>
    </body>
</html>
