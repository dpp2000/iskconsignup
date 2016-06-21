<?php
   //include 'connect.php';

   $AddNew = false;
   $Msg = "Please update the information about you below so that we can serve you better";
   if (!isset($_GET['pwd']) || empty($_GET['pwd']))
   {
      $AddNew = true;
      $Msg = "Interested in receiving occasional emails on upcoming events?<BR />Please provide your contact information below so that we can <BR />
         serve you better. If you have already registered and want to<br />change your preferences, click <a href='RegisteredMember.php'>here</a>.";
   }
   else
   {
      $Pwd = $_GET['pwd'];
      if (!isset($_GET['id']) || ($Pwd % strlen($_GET['id']) != 0))
      {
         die ("Cannot continue. Id not specified or wrong password. Please try clicking from the right link sent in your email or send us an email to notify a problem.");
      }
      $Email = $_GET['id'];
      include 'connect.php';

      mysql_query("insert into ContactsUpdateLog (Email, Type) value ('". $Email . "', 'V')");
      $sql = "SELECT * from Contacts where Email = '".$Email."'";
      $result=mysql_query($sql);
      if (mysql_num_rows($result) < 1)
         die ("Record not found for this email address. Please contact <a href='mailto:ISKCON.Naperville@itogc.org?subject=Email not found'>ISKCON.Naperville@itogc.org</a>");

      mysql_close();

      $FirstName = mysql_result($result, 0, "FirstName");
      $LastName = mysql_result($result, 0, "LastName");
      $HomePhone = mysql_result($result, 0, "HomePhone");
      $CellPhone1 = mysql_result($result, 0, "CellPhone1");
      $FullAddress = mysql_result($result, 0, "FullAddress");
      $Comments = mysql_result($result, 0, "Comments");
      $F_Philosophy = mysql_result($result, 0, "F_Philosophy");
      $F_Volunteer = mysql_result($result, 0, "F_Volunteer");
      $F_Donation = mysql_result($result, 0, "F_Donation");
      $F_Yoga = mysql_result($result, 0, "F_Yoga");
      $F_PrasadamSponsor = mysql_result($result, 0, "F_PrasadamSponsor");
      $F_Samskara = mysql_result($result, 0, "F_Samskara");
      $F_SundaySchool = mysql_result($result, 0, "F_SundaySchool");
      $F_GitaCamp = mysql_result($result, 0, "F_GitaCamp");
   }

   ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
   <head>
      <link rel="stylesheet" type="text/css" href="Redesigned_CSS.css"/>
      <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="HandheldFriendly" content="true">
      <title>Register for the Temple Address Book</title>
      <script src="gen_validatorv4.js" type="text/javascript"></script>
      <script type="text/javascript">
         var _gaq = _gaq || [];
         _gaq.push(['_setAccount', 'UA-32585533-1']);
         _gaq.push(['_trackPageview']);

         (function() {
           var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
           ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
           var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
         })();

      </script>
   </head>
   <center>
      <body>
         <form id="ContactDetails" method="post" action="SaveContact.php">
            <tr>
               <td  colspan="2"><strong><?=$Msg;?></strong></td>
            </tr>
            <tr>
               <td>
                  <div class="divwid">
                     <h4 class = "text">First Name:</h4>
                  </div>
               </td>
            </tr>
            <tr>
               <td><input type="text" name="FirstName" placeholder="First Name" maxlength="50" size="30"<?if ($FirstName != "") echo "value='".$FirstName."'"; ?> /></td>
            </tr>
            <tr>
               <td>
                  <div class="divwid">
                     <h4 class = "text">Last Name:</h4>
                  </div>
               </td>
            </tr>
            <tr>
               <td><input type="text" name="LastName" placeholder="Last Name" maxlength="50" size="30"<?if ($LastName != "") echo "value='".$LastName."'"; ?> /></td>
            </tr>
            <tr>
               <td>
                  <div class="divwid">
                     <h4 class = "text">Email:</h4>
                  </div>
               </td>
            </tr>
            <tr>
               <td>
                  <?if (!$AddNew) {?>
                  <b><?=$Email?></b>
                  <input type="hidden" name="Email" maxlength="100" size="30" <?if ($Email != "") echo "value='".$Email."'"; ?>/>
                  <? } else {?>
                  <input type="hidden" name="AddNew" value='1' />
                  <input type="text" name="Email" placeholder="Email Address"  maxlength="100" size="30" />
                  <? } ?>
               </td>
            </tr>
            <tr>
               <td>
                  <div class="divwid">
                     <h4 class = "text">Home Phone:</h4>
                  </div>
               </td>
            </tr>
            <tr>
               <td><input type="tel" name="HomePhone" placeholder="Home Phone Number" maxlength="20"<?if ($HomePhone != "") echo "value='".$HomePhone."'"; ?> /></td>
            </tr>
            <tr>
               <td>
                  <div class="divwid">
                     <h4 class = "text">Cell Phone:</h4>
                  </div>
               </td>
            </tr>
            <tr>
               <td><input type="tel" name="CellPhone1" placeholder="Cellphone Number" maxlength="20" <?if ($CellPhone1 != "") echo "value='".$CellPhone1."'"; ?> /></td>
            </tr>
            <tr>
               <td>
                  <div class="divwid">
                     <h4 class = "text">Full Address:</h4>
                  </div>
               </td>
            </tr>
            <div style="display: none"><input type="text" name="Address" maxlength="20" value='Your Address' /></div>
            <textarea name="FullAddress" placeholder="Address" rows="5" cols="30"><?if ($FullAddress != "") echo $FullAddress; ?></textarea>
            <tr>
               <td>
                  <div class="divwid">
                     <h4 class = "text">Comments:</h4>
                  </div>
               </td>
            </tr>
            <textarea name="Comments" placeholder="Comments" rows="5" cols="30"><?if ($Comments != "") echo $Comments; ?></textarea>
            <div class="divwid">
               <h4 class="text">Interested In:</h4>
            </div>
            <div class="divwid">
            <table>
               <tr>
                  <td>
                     <input type="hidden" name="F_Philosophy" value="" />
                     <input type="checkbox" name="F_Philosophy" <?if ($F_Philosophy) echo "checked='checked'"; ?> />Philosophy
                  </td>
               </tr>
               <tr>
                  <td>
                     <input type="hidden" name="F_Volunteer" value="" />
                     <input type="checkbox" name="F_Volunteer" <?if ($F_Volunteer) echo "checked='checked'"; ?> />Volunteer
                  </td>
               </tr>
               <tr>
                  <td>
                     <input type="hidden" name="F_Donation" value="" />
                     <input type="checkbox" name="F_Donation" <?if ($F_Donation) echo "checked='checked'"; ?>/>Donation
                  </td>
               </tr>
               <tr>
                  <td>
                     <input type="hidden" name="F_Yoga" value="" />
                     <input type="checkbox" name="F_Yoga" <?if ($F_Yoga) echo "checked='checked'"; ?>/>Yoga
               </tr>
               </td>
               <tr>
                  <td>
                     <input type="hidden" name="F_PrasadamSponsor" value="" />
                     <input type="checkbox" name="F_PrasadamSponsor" <?if ($F_PrasadamSponsor) echo "checked='checked'"; ?> />Prasadam Sponsorship
                  </td>
               </tr>
               <tr>
                  <td>
                     <input type="hidden" name="F_Samskara" value="" />
                     <input type="checkbox" name="F_Samskara" <?if ($F_Samskara) echo "checked='checked'"; ?> />Samskaras
                  </td>
               </tr>
               <tr>
                  <td>
                     <input type="hidden" name="F_SundaySchool" value="" />
                     <input type="checkbox" name="F_SundaySchool" <?if ($F_SundaySchool) echo "checked='checked'"; ?> />Sunday School
                  </td>
               </tr>
               <tr>
                  <td>
                     <input type="hidden" name="F_GitaCamp" value="" />
                     <input type="checkbox" name="F_GitaCamp" <?if ($F_GitaCamp) echo "checked='checked'"; ?> />Summer Gita Camp
                  </td>
               </tr>
            </table>
            <div class="divwid">
               <tr class="submit">
                  <td style="text-align: left"><input type="submit" name="submit" value="Submit"
                     style="width: 100px; font-weight: bold;"/></td>
               </tr>
            </div>
         </form>
         <script type="text/javascript"> var frmvalidator  = new Validator("ContactDetails");
            frmvalidator.addValidation("Email","req","Please enter your Email address");
            frmvalidator.addValidation("Email","maxlen=100");
            frmvalidator.addValidation("Email","email");
         </script>
      </body>
   </center>
</html>
