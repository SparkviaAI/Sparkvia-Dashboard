<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sparkvia AI - Welcome</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: Arial, sans-serif;">

<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td style="padding: 40px 0; background-color: #f4f6f8; text-align: center;">
            <!-- Main container -->
            <table cellpadding="0" cellspacing="0" border="0" width="600" 
                   style="background-color: #ffffff; border-radius: 6px; overflow: hidden; 
                          box-shadow: 0px 2px 6px rgba(0,0,0,0.1); margin: auto; text-align: center;">
                
                <!-- Header -->
                <tr>
                    <td style="padding: 20px; background-color: #ffffff; font-size: 20px; 
                               font-weight: bold; color: #333333;">
                        SPARKVIA AI
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding: 30px 40px; font-size: 16px; color: #333333; line-height: 1.5;">
                        <p style="margin: 0 0 15px 0; font-size: 18px; font-weight: bold;">Hello!</p>
                        <p style="margin: 0 0 15px 0;">
                            You have successfully created an account at 
                            <strong>Sparkvia AI</strong>, with 
                            <strong>100 free spark credits</strong>.
                        </p>
                        <p style="margin: 0 0 25px 0;">
                            Kindly click on the login button below to start writing!
                        </p>

                        <!-- Login Button -->
                        <table cellpadding="0" cellspacing="0" border="0" align="center" style="margin: 20px auto;">
                            <tr>
                                <td bgcolor="#000000" style="border-radius: 4px;">
                                    <a href="{{ route('handleLoggin') }}" 
                                       style="display: inline-block; padding: 12px 25px; font-size: 16px; 
                                              color: #ffffff; text-decoration: none; font-weight: bold; 
                                              background-color: #000000; border-radius: 4px;">
                                        Login
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <p style="margin: 25px 0 0 0; font-size: 14px; color: #777777;">
                            If you did not create an account, no further action is required.
                        </p>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="padding: 15px; text-align: center; background-color: #f4f6f8; 
                               font-size: 12px; color: #999999;">
                        © {{ date('Y') }} SPARKVIA AI. All rights reserved.
                    </td>
                </tr>
            </table>
            <!-- End main container -->
        </td>
    </tr>
</table>

</body>
</html>
