<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <!-- Styles -->
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }

        /* Base */

        body,
        body *:not(html):not(style):not(br):not(tr):not(code) {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
                'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
            position: relative;
        }

        body {
            -webkit-text-size-adjust: none;
            background-color: #f4f4f4;
            color: #333333;
            height: 100%;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            width: 100% !important;
        }

        p,
        ul,
        ol,
        blockquote {
            line-height: 1.4;
            text-align: left;
        }

        a {
            color: #3869d4;
        }

        a img {
            border: none;
        }

        /* Typography */

        h1 {
            color: #333333;
            font-size: 24px;
            font-weight: bold;
            margin-top: 0;
            text-align: left;
        }

        h2 {
            font-size: 20px;
            font-weight: bold;
            margin-top: 0;
            text-align: left;
        }

        h3 {
            font-size: 18px;
            font-weight: bold;
            margin-top: 0;
            text-align: left;
        }

        p {
            font-size: 16px;
            line-height: 1.5em;
            margin-top: 0;
            text-align: left;
        }


        img {
            max-width: 100%;
        }

        /* Layout */

        .wrapper {
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .content {
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        /* Header */

        .header {
            padding: 25px 0;
            text-align: center;
        }

        .header a {
            color: #333333;
            font-size: 19px;
            font-weight: bold;
            text-decoration: none;
        }

        /* Logo */

        .logo {
            width: 100%;
            max-width: 150px;
            height: auto;
        }

        /* Body */

        .body {
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .inner-body {
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 570px;
            background-color: #ffffff;
            border-color: #e8e5ef;
            border-radius: 2px;
            border-width: 1px;
            box-shadow: 0 2px 0 rgba(0, 0, 0, 0.025), 2px 4px 0 rgba(0, 0, 0, 0.015);
            margin: 0 auto;
            padding: 0;
            width: 80%;
        }

        /* Tables */

        .table table {
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
            margin: 30px auto;
            width: 100%;
        }

        .table th {
            border-bottom: 1px solid #edeff2;
            margin: 0;
            padding-bottom: 8px;
        }

        .table td {
            color: #74787e;
            font-size: 15px;
            line-height: 18px;
            margin: 0;
        }

        .content-cell {
            max-width: 100vw;
            padding: 32px;
        }

        /* Footer */

        .nhsuk-footer {
            width: 100%;
            padding: 24px 0;
            background-color: #f4f4f4;
            border-top: 4px solid #00A6C0;
        }

        .nhsuk-footer:after {
            clear: both;
            content: '';
            display: block;
        }

        .nhsuk-footer__list-item-link {
            color: #4c6272;
        }

        .nhsuk-footer__list-item-link:visited {
            color: #4c6272;
        }

        .nhsuk-footer__list-item-link:hover {
            color: #212b32;
        }

        .nhsuk-footer__copyright {
            width: 100%;
            font-weight: 400;
            font-size: 14px;
            line-height: 1.71429;
            color: #4c6272;
            margin-bottom: 0;
            text-align: center;
        }

        @media (min-width: 40.0625em) {
            .nhsuk-footer__copyright {
                font-size: 16px;
                line-height: 1.5;
            }
        }

        @media print {
            .nhsuk-footer__copyright {
                font-size: 14pt;
                line-height: 1.2;
            }
        }

        @media (min-width: 48.0625em) {
            .nhsuk-footer__copyright {
                /* width: 40%; */
            }
        }
    </style>
</head>

<body>

    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="header">
                            <a href="{{ route('root') }}" style="display: inline-block;">
                                <img src="{{ url('assets/images/logo-dark.png') }}" class="logo"
                                    alt="{{ config('constants.APP_NAME') }}" title="{{ config('constants.APP_NAME') }}">
                            </a>
                        </td>
                    </tr>

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0"
                                role="presentation">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell">
                                        <?php echo '{{{ body }}}'; ?>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <?php if (strtoupper(env('APP_ENV')) !== 'PRODUCTION'): ?>
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0"
                                role="presentation">
                                <tr>
                                    <td class="content-cell" style="background-color: white;">
                                        Actual Email notification recipients: <br>
                                        Email Notification - To: <?php echo $TO; ?> <br>
                                        Email Notification - CC: <?php echo $CC; ?><br>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php endif; ?>

                    <!-- Footer -->
                    <tr>
                        <td>
                            <div class="nhsuk-footer">
                                <p class="nhsuk-footer__copyright">
                                    <?php echo date('Y'); ?> &copy; {{ env('APP_NAME') }}.
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
