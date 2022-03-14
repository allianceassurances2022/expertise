<html>
<!-- #A3D0F8 -->

<body style="color: #000; font-size: 16px; text-decoration: none; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #efefef;">

    <div id="wrapper" style="max-width: 600px; margin: auto auto; padding: 20px;">

        <div id="logo" style="">
            <center>
                <h1 style="margin: 0px;"><a href="{SITE_ADDR}" target="_blank"><img style="max-height: 75px;" src="{EMAIL_LOGO}"></a></h1>
            </center>
        </div>

        <div id="content" style="font-size: 16px; padding: 25px; background-color: #fff;
				moz-border-radius: 10px; -webkit-border-radius: 10px; border-radius: 10px; -khtml-border-radius: 10px;
				border-color: teal; border-width: 4px 1px; border-style: solid;">

            <h1 style="font-size: 22px;">
                <center>{EMAIL_TITLE}</center>
            </h1>

            <p>Bonjour {TO_NAME},</p>

            <!--p>Votre sinistre déclaré le {date du sinistre }à été enregistré avec succées, .</p-->
            <p>Vous êtes invité a rejoindre la rénion Zoom avec votre expert.</p>


            <p style="display: flex; justify-content: center; margin-top: 10px;">
                <center>
                    <a href="{CUSTOM_URL}" target="_blank" style="border: 1px solid #0561B3; background-color: teal; 
					color: #fff; text-decoration: none; font-size: 18px; padding: 10px 20px;">Rejoindre la réunion</a>
                </center>
            </p>

        </div>

        <div id="footer" style="margin-bottom: 20px; padding: 0px 8px; text-align: center;">
            even add footer links to your <a href="https://www.heytuts.com/web-dev" target="_blank" style="text-decoration: none; color: #238CEA;">website</a> from these emails
        </div>
    </div>
</body>

</html>