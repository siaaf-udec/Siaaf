<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

@include('vendor.mail.welcome.sections.head')

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td background="{{ asset('assets/pages/mail/images/bg.jpg') }}" bgcolor="#494c50" valign="top" style="background-size: cover; background-position: center;">
            <table border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="50"></td>
                </tr>
                <!-- logo -->
                <tr>
                    <td align="center" style="line-height: 0px;">
                        <img style="display:block; line-height:0px; font-size:0px; border:0px;" src="{{ asset('assets/pages/mail/images/logo.png') }}" alt="logo" />
                    </td>
                </tr>
                <!-- end logo -->
                <tr>
                    <td height="20"></td>
                </tr>
                <!-- content -->
                <tr>
                    <td align="center" style="font-family: 'Open Sans', Arial, sans-serif; font-size:11px; color:#FFFFFF;text-transform:uppercase; letter-spacing:4px;">{{ env('APP_NAME') }}</td>
                </tr>
                <!-- end content -->
                <tr>
                    <td height="40"></td>
                </tr>
                <tr>
                    <td align="center" width="600">
                        <table align="center" bgcolor="#FFFFFF" style="border-radius:4px; box-shadow: 0px -3px 0px #D4D2D2;" width="95%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td height="50"></td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <table align="center" width="90%" border="0" cellspacing="0" cellpadding="0">
                                        <!-- title -->
                                        <tr>
                                            <td align="center" style="font-family: 'Open Sans', Arial, sans-serif; font-size:36px; color:#3b3b3b; font-weight: bold; letter-spacing:4px;"> {{ ( isset( $title ) ) ? $title : 'Bienvenido al Siaaf' }} </td>
                                        </tr>
                                        <!-- end title -->
                                        <tr>
                                            <td align="center">
                                                <table width="25" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td height="20" style="border-bottom:2px solid #d5ca3d;"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="20"></td>
                                        </tr>
                                        <!-- content -->
                                        <tr>
                                            <td align="center" style="font-family: 'Open Sans', Arial, sans-serif; font-size:13px; color:#7f8c8d; line-height:30px;">
                                                {{ ( isset( $body ) ) ? $body : 'Ahora puedes iniciar sesión en la plataforma.' }}
                                                <br>
                                                Sistema de Información para el Apoyo Administrativo UdeC - Facatativá
                                            </td>
                                        </tr>
                                        <!-- end content -->
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="40"></td>
                            </tr>
                            <!-- button -->
                            <tr>
                                <td align="center">
                                    <table class="textbutton" align="center" bgcolor="#d5ca3d" border="0" cellspacing="0" cellpadding="0" style=" border-radius:30px; box-shadow: 0px 1px 0px #D4D2D2;">
                                        <tr>
                                            <td class="btn-link" height="55" align="center" style="font-family: 'Open Sans', Arial, sans-serif; font-size:18px; color:#FFFFFF; font-weight: bold;padding-left: 25px;padding-right: 25px;">
                                                <a href="{{ ( isset($link) ) ? $link : env('APP_URL')  }}"> {{ ( isset($buttom) ) ? $buttom : 'Ir al Siaaf' }} </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- end button -->
                            <tr>
                                <td height="45"></td>
                            </tr>
                            <!-- option -->
                            <tr>
                                <td align="center" bgcolor="#f3f3f3" style=" border-bottom-left-radius:4px; border-bottom-right-radius:4px;">
                                    <table align="center" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td height="15"></td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-family: 'Open Sans', Arial, sans-serif; font-size:13px; color:#d5ca3d;"><a href="javascript:;">C.I.T.</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;">Universidad de Cundinamarca</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;">Siaaf</a></td>
                                        </tr>
                                        <tr>
                                            <td height="15"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- end option -->
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="22" align="center" style="line-height:0px;">
                        <img src="{{ asset('assets/pages/mail/images/point.png') }}" alt="img" width="42" height="22" style="display:block; line-height:0px; font-size:0px; border:0px;" />
                    </td>
                </tr>
                <tr>
                    <td height="30"></td>
                </tr>
                <!-- profile-img -->
                <tr>
                    <td height="100" align="center" style="line-height:0px;">
                        <img style="display:block; line-height:0px; font-size:0px; border:0px;" src="{{ ( isset($picture) ) ? $picture : asset('assets/pages/mail/images/profile.png') }}" alt="img" />
                    </td>
                </tr>
                <!-- end profile-img -->
                <tr>
                    <td height="30"></td>
                </tr>
                <!-- social -->
                <tr>
                    <td align="center">
                        <table align="center" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="center" style="line-height:0xp;">
                                    <a href="javascript:;"> <img style="display:block; line-height:0px; font-size:0px; border:0px;" src="{{ asset('assets/pages/mail/images/fb.png') }}" alt="Facebook" /> </a>
                                </td>
                                <td width="20"></td>
                                <td align="center" style="line-height:0xp;">
                                    <a href="javascript:;"> <img style="display:block; line-height:0px; font-size:0px; border:0px;" src="{{ asset('assets/pages/mail/images/tw.png') }}" alt="Twitter" /> </a>
                                </td>
                                <td width="20"></td>
                                <td align="center" style="line-height:0xp;">
                                    <a href="javascript:;"> <img style="display:block; line-height:0px; font-size:0px; border:0px;" src="{{ asset('assets/pages/mail/images/gg.png') }}" alt="Google Plus" /> </a>
                                </td>
                                <td width="20"></td>
                                <td align="center" style="line-height:0xp;">
                                    <a href="javascript:;"> <img style="display:block; line-height:0px; font-size:0px; border:0px;" src="{{ asset('assets/pages/mail/images/in.png') }}" alt="LinkedIn" /> </a>
                                </td>
                                <td width="20"></td>
                                <td align="center" style="line-height:0xp;">
                                    <a href="javascript:;"> <img style="display:block; line-height:0px; font-size:0px; border:0px;" src="{{ asset('assets/pages/mail/images/bh.png') }}" alt="Bëhance" /> </a>
                                </td>
                                <td width="20"></td>
                                <td align="center" style="line-height:0xp;">
                                    <a href="javascript:;"> <img style="display:block; line-height:0px; font-size:0px; border:0px;" src="{{ asset('assets/pages/mail/images/db.png') }}" alt="Dribbble" /> </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- end social -->
                <tr>
                    <td height="15"></td>
                </tr>
                <!-- copyright -->
                <tr>
                    <td align="center" style="font-family: 'Open Sans', Arial, sans-serif; font-size:13px; color:#FFFFFF;">© {{ \Carbon\Carbon::now()->year }} {{ env('APP_NAME') }}. All Rights Reserved.</td>
                </tr>
                <!-- end copyright -->
                <tr>
                    <td height="30"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

</html>
