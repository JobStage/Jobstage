<?php
include 'vendor/autoload.php';
// Inclua o autoload do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class email {
    private $mail;
    public function __construct() {
        $this->mail = new PHPMailer;
        $this->mail->IsSMTP();        
        $this->mail->SMTPDebug = false;
        $this->mail->SMTPAuth = true;     
        $this->mail->SMTPSecure = 'ssl';  
        $this->mail->Host = 'smtp.gmail.com'; 
        $this->mail->Port = 465; 
        $this->mail->Username = 'nelsonolech@gmail.com'; 
        $this->mail->Password = 'yuhx iolo scbv cclc
';   
    }


    public function templateEmailRecuperarSenha(){
        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
            <head>
            <title></title>
            <meta charset="UTF-8" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

            <meta http-equiv="X-UA-Compatible" content="IE=edge" />

            <meta name="x-apple-disable-message-reformatting" content="" />
            <meta content="target-densitydpi=device-dpi" name="viewport" />
            <meta content="true" name="HandheldFriendly" />
            <meta content="width=device-width" name="viewport" />
            <meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no" />
            <style type="text/css">
            table {
            border-collapse: separate;
            table-layout: fixed;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt
            }
            table td {
            border-collapse: collapse
            }
            .ExternalClass {
            width: 100%
            }
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
            line-height: 100%
            }
            .gmail-mobile-forced-width {
            display: none;
            display: none !important;
            }
            body, a, li, p, h1, h2, h3 {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            }
            html {
            -webkit-text-size-adjust: none !important
            }
            body, #innerTable {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
            }
            #innerTable img+div {
            display: none;
            display: none !important
            }
            img {
            Margin: 0;
            padding: 0;
            -ms-interpolation-mode: bicubic
            }
            h1, h2, h3, p, a {
            line-height: inherit;
            overflow-wrap: normal;
            white-space: normal;
            word-break: break-word
            }
            a {
            text-decoration: none
            }
            h1, h2, h3, p {
            min-width: 100%!important;
            width: 100%!important;
            max-width: 100%!important;
            display: inline-block!important;
            border: 0;
            padding: 0;
            margin: 0
            }
            a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important
            }
            u + #body a {
            color: inherit;
            text-decoration: none;
            font-size: inherit;
            font-family: inherit;
            font-weight: inherit;
            line-height: inherit;
            }
            a[href^="mailto"],
            a[href^="tel"],
            a[href^="sms"] {
            color: inherit;
            text-decoration: none
            }
            </style>
            <style type="text/css">
            @media (min-width: 481px) {
            .hd { display: none!important }
            }
            </style>
            <style type="text/css">
            @media (max-width: 480px) {
            .hm { display: none!important }
            }
            </style>
            <style type="text/css">
            @media (max-width: 480px) {
            .t13,.t19,.t21,.t24,.t28,.t32,.t34,.t36,.t5,.t9{width:420px!important}.t21{padding-bottom:70px!important}.t3{mso-line-height-alt:50px!important;line-height:50px!important}.t15,.t26,.t7{mso-line-height-alt:30px!important;line-height:30px!important}.t5{padding-bottom:30px!important}.t4{line-height:38px!important;font-size:28px!important;mso-text-raise:3px!important}.t11{mso-line-height-alt:18px!important;line-height:18px!important}.t12,.t8{line-height:26px!important;font-size:16px!important}.t16,.t17{line-height:46px!important;mso-text-raise:10px!important}.t16{font-size:12px!important}.t36{padding-top:60px!important;padding-bottom:60px!important}.t24{padding-bottom:40px!important}
            }
            </style>
            <style type="text/css">@media (max-width: 480px) {[class~="x_t21"]{padding-bottom:70px!important;width:420px!important;} [class~="x_t19"]{width:420px!important;} [class~="x_t3"]{mso-line-height-alt:50px!important;line-height:50px!important;} [class~="x_t7"]{mso-line-height-alt:30px!important;line-height:30px!important;} [class~="x_t5"]{padding-bottom:30px!important;width:420px!important;} [class~="x_t4"]{line-height:38px!important;font-size:28px!important;mso-text-raise:3px!important;} [class~="x_t11"]{mso-line-height-alt:18px!important;line-height:18px!important;} [class~="x_t9"]{width:420px!important;} [class~="x_t8"]{line-height:26px!important;font-size:16px!important;} [class~="x_t15"]{mso-line-height-alt:30px!important;line-height:30px!important;} [class~="x_t13"]{width:420px!important;} [class~="x_t12"]{line-height:26px!important;font-size:16px!important;} [class~="x_t17"]{line-height:46px!important;mso-text-raise:10px!important;} [class~="x_t16"]{line-height:46px!important;font-size:12px!important;mso-text-raise:10px!important;} [class~="x_t36"]{padding-top:60px!important;padding-bottom:60px!important;width:420px!important;} [class~="x_t34"]{width:420px!important;} [class~="x_t26"]{mso-line-height-alt:30px!important;line-height:30px!important;} [class~="x_t24"]{padding-bottom:40px!important;width:420px!important;} [class~="x_t28"]{width:420px!important;} [class~="x_t32"]{width:420px!important;}}</style>

            <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;600;700&amp;family=Montserrat:wght@800&amp;display=swap" rel="stylesheet" type="text/css" />

            </head>
            <body id="body" class="t40" style="min-width:100%;Margin:0px;padding:0px;background-color:#837f7e;"><div class="t39" style="background-color:#EDEDED;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td class="t38" style="font-size:0;line-height:0;mso-line-height-rule:exactly;background-color:#959595;" valign="top" align="center">

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" align="center" id="innerTable" style="margin: 10px 0;"><tr><td align="center">
            <table class="t22" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t21" style="background-color:#FFFFFF;width:620px;padding:60px 30px 100px 30px;">

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="center">
            <table class="t20" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>


            <td class="t19" style="background-color:transparent;width:475px;">

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="left">
            <table class="t2" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
            <tr>


            <td class="t1" style="width:40px;">

            <div style="font-size:0px;"><img class="t0" style="display:block;border:0;height:auto;width:60px;Margin:0;" width="40" height="39.34375" alt="" src="https://avatars.githubusercontent.com/u/164968077?s=200&v=4"/></div></td>
            </tr></table>
            </td></tr><tr><td><div class="t3" style="mso-line-height-rule:exactly;mso-line-height-alt:90px;line-height:60px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="center">
            <table class="t6" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t5" style="border-bottom:1px solid #E1E2E6;width:475px;padding:0 0 40px 0;">
            <h1 class="t4" style="margin:0;Margin:0;font-family:Fira Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:52px;font-weight:700;font-style:normal;font-size:48px;text-decoration:none;text-transform:none;direction:ltr;color:#000000;text-align:left;mso-line-height-rule:exactly;mso-text-raise:1px;">Redefinir senha</h1></td>
            </tr></table>
            </td></tr><tr><td><div class="t7" style="mso-line-height-rule:exactly;mso-line-height-alt:40px;line-height:40px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="center">
            <table class="t10" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t9" style="width:475px;">
            <p class="t8" style="margin:0;Margin:0;font-family:Fira Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:28px;font-weight:400;font-style:normal;font-size:18px;text-decoration:none;text-transform:none;direction:ltr;color:#9095A2;text-align:left;mso-line-height-rule:exactly;mso-text-raise:3px;">Você está recebendo este e-mail pois solicitou a redifinição de sua senha da plataforma JobStage</p></td>
            </tr></table>
            </td></tr><tr><td><div class="t11" style="mso-line-height-rule:exactly;mso-line-height-alt:28px;line-height:28px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="center">
            <table class="t14" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t13" style="width:475px;">

            <p class="t12" style="margin:0;Margin:0;font-family:Fira Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:28px;font-weight:400;font-style:normal;font-size:18px;text-decoration:none;text-transform:none;direction:ltr;color:#9095A2;text-align:left;mso-line-height-rule:exactly;mso-text-raise:3px;">Clique no botão abaixo para criar uma nova senha para a sua conta</p></td>
            </tr></table>
            </td></tr><tr><td><div class="t15" style="mso-line-height-rule:exactly;mso-line-height-alt:50px;line-height:50px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="left">
            <table class="t18" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
            <tr>

            <td class="t17" style="background-color:#003aff;overflow:hidden;width:246px;text-align:center;line-height:48px;mso-line-height-rule:exactly;mso-text-raise:11px;border-radius:40px 40px 40px 40px;">
            <a class="t16" href="http://localhost/Jobstage" style="display:block;margin:0;Margin:0;font-family:Montserrat,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:48px;font-weight:800;font-style:normal;font-size:13px;text-decoration:none;text-transform:uppercase;letter-spacing:0.5px;direction:ltr;color:#FFFFFF;text-align:center;mso-line-height-rule:exactly;mso-text-raise:11px;" target="_blank">Resetar senha</a></td>
            </tr></table>
            </td></tr></table></td>
            </tr></table>
            </td></tr></table></td>
            </tr></table>
            </td></tr><tr><td align="center">
            <table class="t37" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t36" style="background-color:#000000;width:620px;padding:80px 30px 80px 30px;">

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="center">
            <table class="t35" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t34" style="background-color:transparent;width:475px;">

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="center">
            <table class="t25" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t24" style="border-bottom:1px solid #262626;width:475px;padding:0 0 60px 0;">

            <h1 class="t23" style="margin:0;Margin:0;font-family:Fira Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:32px;font-weight:600;font-style:normal;font-size:32px;text-decoration:none;text-transform:none;direction:ltr;color:#FFFFFF;text-align:left;mso-line-height-rule:exactly;">JobStage</h1></td>
            </tr></table>
            </td></tr><tr><td><div class="t26" style="mso-line-height-rule:exactly;mso-line-height-alt:40px;line-height:40px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="center">
            <table class="t29" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t28" style="width:475px;">
            <p class="t27" style="margin:0;Margin:0;font-family:Fira Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:400;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;direction:ltr;color:#9095A2;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">Se não foi você quem solicitou essa redifinição de senha você pode ignorar este email</p></td>
            </tr></table>
            </td></tr><tr><td><div class="t30" style="mso-line-height-rule:exactly;mso-line-height-alt:20px;line-height:20px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="center">
            <table class="t33" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t32" style="width:475px;">

            <p class="t31" style="margin:0;Margin:0;font-family:Fira Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:400;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;direction:ltr;color:#9095A2;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">JobStage - Todos os direitos reservados</p></td>
            </tr></table>
            </td></tr></table></td>
            </tr></table>
            </td></tr></table></td>
            </tr></table>
            </td></tr></table></td></tr></table></div><div class="gmail-mobile-forced-width" style="white-space: nowrap; font: 15px courier; line-height: 0;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            </div></body>
            </html>
        ';
        
        return $html;
    }


    public function templateEmailAssinatura($hash, $nomeFunc, $idFunc){
        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
            <head>
            <title></title>
            <meta charset="UTF-8" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

            <meta http-equiv="X-UA-Compatible" content="IE=edge" />

            <meta name="x-apple-disable-message-reformatting" content="" />
            <meta content="target-densitydpi=device-dpi" name="viewport" />
            <meta content="true" name="HandheldFriendly" />
            <meta content="width=device-width" name="viewport" />
            <meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no" />
            <style type="text/css">
            table {
            border-collapse: separate;
            table-layout: fixed;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt
            }
            table td {
            border-collapse: collapse
            }
            .ExternalClass {
            width: 100%
            }
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
            line-height: 100%
            }
            .gmail-mobile-forced-width {
            display: none;
            display: none !important;
            }
            body, a, li, p, h1, h2, h3 {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            }
            html {
            -webkit-text-size-adjust: none !important
            }
            body, #innerTable {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
            }
            #innerTable img+div {
            display: none;
            display: none !important
            }
            img {
            Margin: 0;
            padding: 0;
            -ms-interpolation-mode: bicubic
            }
            h1, h2, h3, p, a {
            line-height: inherit;
            overflow-wrap: normal;
            white-space: normal;
            word-break: break-word
            }
            a {
            text-decoration: none
            }
            h1, h2, h3, p {
            min-width: 100%!important;
            width: 100%!important;
            max-width: 100%!important;
            display: inline-block!important;
            border: 0;
            padding: 0;
            margin: 0
            }
            a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important
            }
            u + #body a {
            color: inherit;
            text-decoration: none;
            font-size: inherit;
            font-family: inherit;
            font-weight: inherit;
            line-height: inherit;
            }
            a[href^="mailto"],
            a[href^="tel"],
            a[href^="sms"] {
            color: inherit;
            text-decoration: none
            }
            </style>
            <style type="text/css">
            @media (min-width: 481px) {
            .hd { display: none!important }
            }
            </style>
            <style type="text/css">
            @media (max-width: 480px) {
            .hm { display: none!important }
            }
            </style>
            <style type="text/css">
            @media (max-width: 480px) {
            .t13,.t19,.t21,.t24,.t28,.t32,.t34,.t36,.t5,.t9{width:420px!important}.t21{padding-bottom:70px!important}.t3{mso-line-height-alt:50px!important;line-height:50px!important}.t15,.t26,.t7{mso-line-height-alt:30px!important;line-height:30px!important}.t5{padding-bottom:30px!important}.t4{line-height:38px!important;font-size:28px!important;mso-text-raise:3px!important}.t11{mso-line-height-alt:18px!important;line-height:18px!important}.t12,.t8{line-height:26px!important;font-size:16px!important}.t16,.t17{line-height:46px!important;mso-text-raise:10px!important}.t16{font-size:12px!important}.t36{padding-top:60px!important;padding-bottom:60px!important}.t24{padding-bottom:40px!important}
            }
            </style>
            <style type="text/css">@media (max-width: 480px) {[class~="x_t21"]{padding-bottom:70px!important;width:420px!important;} [class~="x_t19"]{width:420px!important;} [class~="x_t3"]{mso-line-height-alt:50px!important;line-height:50px!important;} [class~="x_t7"]{mso-line-height-alt:30px!important;line-height:30px!important;} [class~="x_t5"]{padding-bottom:30px!important;width:420px!important;} [class~="x_t4"]{line-height:38px!important;font-size:28px!important;mso-text-raise:3px!important;} [class~="x_t11"]{mso-line-height-alt:18px!important;line-height:18px!important;} [class~="x_t9"]{width:420px!important;} [class~="x_t8"]{line-height:26px!important;font-size:16px!important;} [class~="x_t15"]{mso-line-height-alt:30px!important;line-height:30px!important;} [class~="x_t13"]{width:420px!important;} [class~="x_t12"]{line-height:26px!important;font-size:16px!important;} [class~="x_t17"]{line-height:46px!important;mso-text-raise:10px!important;} [class~="x_t16"]{line-height:46px!important;font-size:12px!important;mso-text-raise:10px!important;} [class~="x_t36"]{padding-top:60px!important;padding-bottom:60px!important;width:420px!important;} [class~="x_t34"]{width:420px!important;} [class~="x_t26"]{mso-line-height-alt:30px!important;line-height:30px!important;} [class~="x_t24"]{padding-bottom:40px!important;width:420px!important;} [class~="x_t28"]{width:420px!important;} [class~="x_t32"]{width:420px!important;}}</style>

            <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;600;700&amp;family=Montserrat:wght@800&amp;display=swap" rel="stylesheet" type="text/css" />

            </head>
            <body id="body" class="t40" style="min-width:100%;Margin:0px;padding:0px;background-color:#837f7e;"><div class="t39" style="background-color:#EDEDED;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td class="t38" style="font-size:0;line-height:0;mso-line-height-rule:exactly;background-color:#959595;" valign="top" align="center">

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" align="center" id="innerTable" style="margin: 10px 0;"><tr><td align="center">
            <table class="t22" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t21" style="background-color:#FFFFFF;width:620px;padding:60px 30px 100px 30px;">

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="center">
            <table class="t20" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>


            <td class="t19" style="background-color:transparent;width:475px;">

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="left">
            <table class="t2" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
            <tr>


            <td class="t1" style="width:40px;">

            <div style="font-size:0px;"><img class="t0" style="display:block;border:0;height:auto;width:60px;Margin:0;" width="40" height="39.34375" alt="" src="https://avatars.githubusercontent.com/u/164968077?s=200&v=4"/></div></td>
            </tr></table>
            </td></tr><tr><td><div class="t3" style="mso-line-height-rule:exactly;mso-line-height-alt:90px;line-height:60px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="center">
            <table class="t6" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t5" style="border-bottom:1px solid #E1E2E6;width:475px;padding:0 0 40px 0;">
            <h1 class="t4" style="margin:0;Margin:0;font-family:Fira Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:52px;font-weight:700;font-style:normal;font-size:48px;text-decoration:none;text-transform:none;direction:ltr;color:#000000;text-align:left;mso-line-height-rule:exactly;mso-text-raise:1px;">Assinatura de contrato</h1></td>
            </tr></table>
            </td></tr><tr><td><div class="t7" style="mso-line-height-rule:exactly;mso-line-height-alt:40px;line-height:40px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="center">
            <table class="t10" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t9" style="width:475px;">
            <p class="t8" style="margin:0;Margin:0;font-family:Fira Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:28px;font-weight:400;font-style:normal;font-size:18px;text-decoration:none;text-transform:none;direction:ltr;color:#9095A2;text-align:left;mso-line-height-rule:exactly;mso-text-raise:3px;">Olá ' . $nomeFunc . '! Você está recebendo este email para realizar a assinatura eletrônica de um contrato de estágio através da plataforma JobStage</p></td>
            </tr></table>
            </td></tr><tr><td><div class="t11" style="mso-line-height-rule:exactly;mso-line-height-alt:28px;line-height:28px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="center">
            <table class="t14" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t13" style="width:475px;">

            <p class="t12" style="margin:0;Margin:0;font-family:Fira Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:28px;font-weight:400;font-style:normal;font-size:18px;text-decoration:none;text-transform:none;direction:ltr;color:#9095A2;text-align:left;mso-line-height-rule:exactly;mso-text-raise:3px;">Clique no botão abaixo para assinar o contrato</p></td>
            </tr></table>
            </td></tr><tr><td><div class="t15" style="mso-line-height-rule:exactly;mso-line-height-alt:50px;line-height:50px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="left">
            <table class="t18" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
            <tr>

            <td class="t17" style="background-color:#003aff;overflow:hidden;width:246px;text-align:center;line-height:48px;mso-line-height-rule:exactly;mso-text-raise:11px;border-radius:40px 40px 40px 40px;">
            <a class="t16" href="http://localhost/Jobstage/empresa/assinatura.php?contrato='.$hash.'&userId='.$idFunc.'" style="display:block;margin:0;Margin:0;font-family:Montserrat,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:48px;font-weight:800;font-style:normal;font-size:13px;text-decoration:none;text-transform:uppercase;letter-spacing:0.5px;direction:ltr;color:#FFFFFF;text-align:center;mso-line-height-rule:exactly;mso-text-raise:11px;" target="_blank">Assinar contrato</a></td>
            </tr></table>
            </td></tr></table></td>
            </tr></table>
            </td></tr></table></td>
            </tr></table>
            </td></tr><tr><td align="center">
            <table class="t37" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t36" style="background-color:#000000;width:620px;padding:80px 30px 80px 30px;">

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="center">
            <table class="t35" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t34" style="background-color:transparent;width:475px;">

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="center">
            <table class="t25" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t24" style="border-bottom:1px solid #262626;width:475px;padding:0 0 60px 0;">

            <h1 class="t23" style="margin:0;Margin:0;font-family:Fira Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:32px;font-weight:600;font-style:normal;font-size:32px;text-decoration:none;text-transform:none;direction:ltr;color:#FFFFFF;text-align:left;mso-line-height-rule:exactly;">JobStage</h1></td>
            </tr></table>
            </td></tr><tr><td><div class="t26" style="mso-line-height-rule:exactly;mso-line-height-alt:40px;line-height:40px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="center">
            <table class="t29" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t28" style="width:475px;">
            <p class="t27" style="margin:0;Margin:0;font-family:Fira Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:400;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;direction:ltr;color:#9095A2;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">Se você não reconhece os dados contidos neste email você pode ignorar


            </p></td>
            </tr></table>
            </td></tr><tr><td><div class="t30" style="mso-line-height-rule:exactly;mso-line-height-alt:20px;line-height:20px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="center">
            <table class="t33" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t32" style="width:475px;">

            <p class="t31" style="margin:0;Margin:0;font-family:Fira Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:400;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;direction:ltr;color:#9095A2;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">JobStage - Todos os direitos reservados</p></td>
            </tr></table>
            </td></tr></table></td>
            </tr></table>
            </td></tr></table></td>
            </tr></table>
            </td></tr></table></td></tr></table></div><div class="gmail-mobile-forced-width" style="white-space: nowrap; font: 15px courier; line-height: 0;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            </div></body>
            </html>';
        return $html;
    }

    public function enviarEmailAssinaturaFuncionario($hash, $nomeFunc, $emailFunc, $idFunc){
        try {
            $this->mail->SetFrom('nelsonolech@gmail.com', 'JobStage'); 
            $this->mail->addAddress($emailFunc, 'Assinatura de contrato');
            $this->mail->Subject = 'Assinatura de contrato';
            $this->mail->isHTML(true);
            
            $this->mail->CharSet = 'UTF-8';
            
            $this->mail->Body = $this->templateEmailAssinatura($hash, $nomeFunc,$idFunc);
            
            $this->mail->AltBody = 'Este é o corpo alternativo da mensagem, sem HTML.';
            
            if ($this->mail->send()) {
               return true;
            } 
        } catch (Exception $e) {
            return false;
        }
     
    }

}

?>