<?php

namespace App\Helpers;

use App\ProductImage;

class Mail
{

    public static function send($emailAddress, $message, $subject, $fullname)
    {

	$message = self::emailHeader().$message.self::emailFooter();

		require_once __DIR__.'/../../includes/class.phpmailer.php';



        $email = new \PHPMailer();

        $email->IsSMTP();

        //$email->SMTPDebug  = 2;

        $email->Encoding = "base64";

        $email->SMTPAuth   = true;

        $email->Host       = SMTP_HOST;

        $email->Port       = 587;

        $email->Username   = SMTP_EMAIL;

        $email->Password   = SMTP_PASSWORD;

        $email->From      = SMTP_EMAIL;

        $email->FromName  = COMPANY_NAME;

        $email->Subject   = $subject;

        $email->MsgHTML($message);

        $email->AddAddress( trim($emailAddress) );

        $email->Send();

    }

    public static function registerToClient($name)
    {

        $redirect = $_SERVER['HTTP_REFERER'];

        $message = "<p>Dear ". $name ."</p>";
        $message .= "<p>Thank you for applying for a Trade Account with The Artisan Bed Company.</p>";
        $message .= "<p>We personally approve each applicant, please bear with us and we will notify you once your Trade Account has been approved.</p>";
        $message .= "<p>The Artisan Bed Company</p>";
        $message .= "<p>T: <a href='tel:01924 466269'>01924 466269</a></p>";
        $message .= "<p>E: <a href='mailto:info@theartisanbedcompany.co.uk'>info@theartisanbedcompany.co.uk</a></p>";

        self::send(SMTP_EMAIL, $message, 'Trade Account', COMPANY_NAME);
    }
    public static function registerToCustomer($email,$name)
    {

        $redirect = $_SERVER['HTTP_REFERER'];

        $message = "<p>Dear ". $name ."</p>";
        $message .= "<p>Thank you for applying for a Trade Account with The Artisan Bed Company.</p>";
        $message .= "<p>We personally approve each applicant, please bear with us and we will notify you once your Trade Account has been approved.</p>";
        $message .= "<p>The Artisan Bed Company</p>";
        $message .= "<p>T: <a href='tel:01924 466269'>01924 466269</a></p>";
        $message .= "<p>E: <a href='mailto:info@theartisanbedcompany.co.uk'>info@theartisanbedcompany.co.uk</a></p>";

        self::send($email, $message, 'Trade Account', COMPANY_NAME);
    }

    public static function enquiry()
    {

	$message = '<table width="500" cellpadding="10" cellspacing="0" border="1" style="font-family:arial">';
	$message .= '<tr><td colspan="2" bgcolor="#EAEAEA"><strong>You have a website enquiry</strong></td></tr>';
	$message .= '<tr><td>Contact Name:</td><td>'.$_POST['name'].'</td></tr>';
	$message .= '<tr><td>Email Address:</td><td>'.$_POST['email'].'</td></tr>';

        $message .= '<tr><td>Phone:</td><td>'.$_POST['phone'].'</td></tr>';
	$message .= '<tr><td>Message:</td><td>'.$_POST['message'].'</td></tr>';

	$message .= '</table>';
	self::send(SMTP_EMAIL, $message, 'Enquiry Form', COMPANY_NAME);
    return redirect(DOMAIN . "/contact", "Thank you for getting in touch with us, we will get back to you as soon as possible!");


    }

    public static function shareEmail($row,$sendTo)
    {


        $productImageObj = new ProductImage();
$i = 1;
$image = "";
foreach ($productImageObj->getAll($row->id) as $product_image) {
    $image = DOMAIN ."/product-images/". $product_image->id.".".$product_image->ext;
    break;
}




        $message = '<table>
            <tr>
            <td>
            <div style="background: #f2f2f2;padding: 15px;border-radius: 10px;">
            <img src="'. $image .'" style="width: 100%;"> 
                <h1 style="margin-top: 3px !important;font-size: 27px;font-family: Calibri">'. $row->title .'</h1>
                <p style="margin-bottom: 0px !important;font-weight: 500;font-family: Calibri">Availability: <span style="width: 10px;height: 10px;border-radius: 100%;background:#1fac1f;display: inline-block;margin-right: 1px; "></span> '. $row->qty_available .' in stock</p>
                
               
                    
                    
                <p style="margin-top: 5px !important;font-family: Calibri">Price: &pound;'. $row->price .'</p>
                <div style="">
                <a href="'. DOMAIN .'/product/'. $row->seo_url .'" target="_blank">
                    <button onclick="window.location.href="'. DOMAIN .'/product/'. $row->seo_url .'" style="font-family: Calibri;width: 100%;background: #d00000;color:white;border:0 !important;border-radius: 5px;padding: 6px;padding-left: 15px !important;padding-right: 15px !important;">VIEW PRODUCT</button>
                    
                </a>
                   
                </div>
</div>
                
               
            </td>
            </tr>
        </table>';

        self::send(SMTP_EMAIL, $message, $row->title, COMPANY_NAME);
        return redirect(DOMAIN . "/product/".$row->seo_url, "Thank you for sharing this product!");


    }
    

    public static function newsletter()
    {

	$message = "You have a newsletter sign up.<br /><br />Email: ".$_POST['newsletter_email'];
	self::send('info@wts-group.com', $message, 'Newsletter Sign Up', COMPANY_NAME);
	return redirect( 'contact', 'Thank you, you have been added to our mailing list' );

    }


    public static function emailHeader()
    {

	return '<!DOCTYPE HTML>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Message</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body bgcolor="#FFFFFF">
  <table border="0" cellpadding="10" cellspacing="0" style=
  "background-color: #FFFFFF" width="100%">
    <tr>
      <td>
        <!--[if (gte mso 9)|(IE)]>
      <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td>
    <![endif]-->

        <table align="center" border="0" cellpadding="0" cellspacing="0" class=
        "content" style="background-color: #FFFFFF">
          <tr>
            <td id="templateContainerHeader" valign="top" mc:edit="welcomeEdit-01">
              <p style="text-align:center;margin:0;padding:0;"><img width="181" src="'.DOMAIN.'/images/logo.png" style="display:inline-block;"></p>
			<br><br>
            </td>
          </tr>

          <tr>
            <td align="center" valign="top">';

    }


   public static function emailFooter()
    {

	return '</td>
                </tr>
              </table>
            </td>
          </tr>
 
          <tr>
            <td align="center" class="unSubContent" id="bodyCellFooter" valign=
            "top">
              <table border="0" cellpadding="0" cellspacing="0" id=
              "templateContainerFooter" width="100%">
                <tr>
                  <td valign="top" width="100%" mc:edit="welcomeEdit-11">

                    <p style="text-align:center;margin-top: 20px; color:#A1A1A1;font-size:14px;margin-bottom:0px">'.COMPANY_NAME.'</p>
                    <p style="text-align:center;margin-top: 0px; color:#A1A1A1;font-size:14px"><a style="color:#A1A1A1;text-decoration:none" href="'.DOMAIN.'">'.DOMAIN.'</a></p>

                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table><!--[if (gte mso 9)|(IE)]>
          </td>
        </tr>
    </table>
    <![endif]-->
      </td>
    </tr>
  </table>

  <style type="text/css">

    span.preheader {
    display:none!important
    }
    td ul li {
      font-size: 16px;
    }
    
    p{ font-size:16px }

    /* /\/\/\/\/\/\/\/\/ CLIENT-SPECIFIC STYLES /\/\/\/\/\/\/\/\/ */
    #outlook a {
    padding:0
    }

    /* Force Outlook to provide a "view in browser" message */
    .ReadMsgBody {
    width:100%
    }

    .ExternalClass {
    width:100%
    }

    /* Force Hotmail to display emails at full width */
    .ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div {
    line-height:100%
    }

    /* Force Hotmail to display normal line spacing */
    body,table,td,p,a,li,blockquote {
    -webkit-text-size-adjust:100%;
    -ms-text-size-adjust:100%
    }

    /* Prevent WebKit and Windows mobile changing default text sizes */
    table,td {
    mso-table-lspace:0;
    mso-table-rspace:0
    }

    /* Remove spacing between tables in Outlook 2007 and up */
    /* /\/\/\/\/\/\/\/\/ RESET STYLES /\/\/\/\/\/\/\/\/ */
    body {
    margin:0;
    padding:0
    }

    img {
    max-width:100%;
    border:0;
    line-height:100%;
    outline:none;
    text-decoration:none
    }

    table {
    border-collapse:collapse!important
    }

    .content {
    width:100%;
    max-width:600px
    }

    .content img {
    height:auto;
    min-height:1px
    }

    #bodyTable {
    margin:0;
    padding:0;
    width:100%!important
    }

    #bodyCell {
    margin:0;
    padding:0
    }

    #bodyCellFooter {
    margin:0;
    padding:0;
    width:100%!important;
    padding-top:39px;
    padding-bottom:15px
    }

    body {
    margin:0;
    padding:0;
    min-width:100%!important
    }

    #templateContainerHeader {
    font-size:16px;
    padding-top:1.429em;
    padding-bottom:.929em
    }

    #templateContainerFootBrd {
    border-bottom:1px solid #e2e2e2;
    border-left:1px solid #e2e2e2;
    border-right:1px solid #e2e2e2;
    border-radius:0 0 4px 4px;
    background-clip:padding-box;
    border-spacing:0;
    height:10px;
    width:100%!important
    }

    #templateContainer {
    border-top:1px solid #e2e2e2;
    border-left:1px solid #e2e2e2;
    border-right:1px solid #e2e2e2;
    border-radius:4px 4px 0 0;
    background-clip:padding-box;
    border-spacing:0
    }

    #templateContainerMiddle {
    border-left:1px solid #e2e2e2;
    border-right:1px solid #e2e2e2
    }

    #templateContainerMiddleBtm {
    border-left:1px solid #e2e2e2;
    border-right:1px solid #e2e2e2;
    border-bottom:1px solid #e2e2e2;
    border-radius:0 0 4px 4px;
    background-clip:padding-box;
    border-spacing:0
    }

    #templateContainerMiddleBtm .bodyContent {
    padding-bottom:2em
    }



    .unSubContent a:visited {
    color:#a1a1a1;
    text-decoration:underline;
    font-weight:400
    }

    .unSubContent a:focus {
    color:#a1a1a1;
    text-decoration:underline;
    font-weight:400
    }

    .unSubContent a:hover {
    color:#a1a1a1;
    text-decoration:underline;
    font-weight:400
    }

    .unSubContent a:link {
    color:#a1a1a1;
    text-decoration:underline;
    font-weight:400
    }

    .unSubContent a .yshortcuts {
    color:#a1a1a1;
    text-decoration:underline;
    font-weight:400
    }

    .unSubContent h6 {
    color:#a1a1a1;
    font-size:12px;
    line-height:1.5em;
    margin-bottom:0
    }

    .bodyContent {
    color:#505050;
    font-family:Helvetica;
    font-size:14px;
    line-height:150%;
    padding-top:3.143em;
    padding-right:3.5em;
    padding-left:3.5em;
    padding-bottom:.714em;
    text-align:left
    }

    .bodyContentImage {
    color:#505050;
    font-family:Helvetica;
    font-size:14px;
    line-height:150%;
    padding-top:0;
    padding-right:3.571em;
    padding-left:3.571em;
    padding-bottom:1.357em;
    text-align:left
    }

    .bodyContentImage h4 {
    color:#4E4E4E;
    font-size:13px;
    line-height:1.154em;
    font-weight:400;
    margin-bottom:0
    }

    .bodyContentImage h5 {
    color:#828282;
    font-size:12px;
    line-height:1.667em;
    margin-bottom:0
    }


    a:visited {
    color:#3386e4;
    text-decoration:none;
    }

    a:focus {
    color:#3386e4;
    text-decoration:none;
    }

    a:hover {
    color:#3386e4;
    text-decoration:none;
    }

    a:link {
    color:#3386e4;
    text-decoration:none;
    }

    a .yshortcuts {
    color:#3386e4;
    text-decoration:none;
    }

    .bodyContent img {
    height:auto;
    max-width:498px
    }

    .footerContent {
    color:gray;
    font-family:Helvetica;
    font-size:10px;
    line-height:150%;
    padding-top:2em;
    padding-right:2em;
    padding-bottom:2em;
    padding-left:2em;
    text-align:left
    }


    .footerContent a:link,.footerContent a:visited,/* Yahoo! Mail Override */ .footerContent a .yshortcuts,.footerContent a span /* Yahoo! Mail Override */ {
    color:#606060;
    font-weight:400;
    text-decoration:underline
    }


    .bodyContentImageFull p {
    font-size:0!important;
    margin-bottom:0!important
    }

    .brdBottomPadd {
    border-bottom:1px solid #f0f0f0
    }

    .brdBottomPadd-two {
    border-bottom:1px solid #f0f0f0
    }

    .brdBottomPadd .bodyContent {
    padding-bottom:2.286em
    }

    .brdBottomPadd-two .bodyContent {
    padding-bottom:.857em
    }

    a.blue-btn {
      background: #5098ea;
      display: inline-block;
      color: #FFFFFF;
      border-top:10px solid #5098ea;
      border-bottom:10px solid #5098ea;
      border-left:20px solid #5098ea;
      border-right:20px solid #5098ea;
      text-decoration: none;
      font-size: 14px;
      margin-top: 1.0em;
      border-radius: 3px 3px 3px 3px;
      background-clip: padding-box;
    }

    .bodyContentTicks {
    color:#505050;
    font-family:Helvetica;
    font-size:14px;
    line-height:150%;
    padding-top:2.857em;
    padding-right:3.5em;
    padding-left:3.5em;
    padding-bottom:1.786em;
    text-align:left
    }

    .splitTicks {
    width:100%
    }

    .splitTicks--one {
    width:19%;
    color:#505050;
    font-family:Helvetica;
    font-size:14px;
    padding-bottom:1.143em
    }

    .splitTicks--two {
    width:5%
    }

    .splitTicks--three {
    width:71%;
    color:#505050;
    font-family:Helvetica;
    font-size:14px;
    padding-top:.714em
    }

    .splitTicks--three h3 {
    margin-bottom:.278em
    }

    .splitTicks--four {
    width:5%
    }

    @media only screen and (max-width: 550px),screen and (max-device-width: 550px) {
    body[yahoo] .hide {
    display:none!important
    }

    body[yahoo] .buttonwrapper {
    background-color:transparent!important
    }

    body[yahoo] .button {
    padding:0!important
    }

    body[yahoo] .button a {
    background-color:#e05443;
    padding:15px 15px 13px!important
    }

    body[yahoo] .unsubscribe {
    font-size:14px;
    display:block;
    margin-top:.714em;
    padding:10px 50px;
    background:#2f3942;
    border-radius:5px;
    text-decoration:none!important
    }
    }

    @media only screen and (max-width: 480px),screen and (max-device-width: 480px) {
      .bodyContentTicks {
        padding:6% 5% 5% 6%!important
      }

      .bodyContentTicks td {
        padding-top:0!important
      }

      h1 {
        font-size:34px!important
      }

      h2 {
        font-size:30px!important
      }

      h3 {
        font-size:24px!important
      }

      h4 {
        font-size:18px!important
      }

      h5 {
        font-size:16px!important
      }

      h6 {
        font-size:14px!important
      }

      p {
        font-size:18px!important
      }

      .brdBottomPadd .bodyContent {
        padding-bottom:2.286em!important
      }

      .brdBottomPadd-two .bodyContent {
        padding-bottom:.857em!important
      }

      #templateContainerMiddleBtm .bodyContent {
        padding:6% 5% 5% 6%!important
      }

      .bodyContent {
        padding:6% 5% 1% 6%!important
      }

      .bodyContent img {
        max-width:100%!important
      }

      .bodyContentImage {
        padding:3% 6% 6%!important
      }

      .bodyContentImage img {
        max-width:100%!important
      }

      .bodyContentImage h4 {
        font-size:16px!important
      }

      .bodyContentImage h5 {
        font-size:15px!important;
        margin-top:0
      }
    }
    .ii a[href] {color: inherit !important;}
    span > a, span > a[href] {color: inherit !important;}
    a > span, .ii a[href] > span {text-decoration: inherit !important;}
  </style>

</body>
</html>';

    }


}
