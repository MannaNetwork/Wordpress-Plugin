<?php

/**
 * Please note: we can use unencoded characters like ö, é etc here as we use the html5 doctype with utf8 encoding
 * in the application's header (in views/_header.php). To add new languages simply copy this file,
 * and create a language switch in your root files.
 */

// login & registration classes

/**
 * Please note: we can use unencoded characters like ö, é etc here as we use the html5 doctype with utf8 encoding
 * in the application's header (in views/_header.php). To add new languages simply copy this file,
 * and create a language switch in your root files.
 */

// login & registration classes
define("REGISTRATION_CATEGORY_HEADING", "<h4>SELECT CATEGORY (Required)</h4>");
define("REGISTRATION_REGIONAL_HEADING", "<h4>ADD REGIONAL INFO (Optional)</h4>");
define("WORDING_LINKEXCHANGE_PAGE_NAME", "PAGE");
define("WORDING_REGIONAL_FILTERS_LABEL", "<h4>Filter Results To Selected Location</h4>");
define("WORDING_REGIONAL_REG_LABEL", "<h4>OFFER BY<BR>LOCATION</h4>");
define("WORDING_AJAX_1", "More Subcategories Available After Selection");
define("WORDING_AJAX_2", "Still More Subcategories To Choose From");
define("WORDING_AJAX_REGIONAL_FILTER_LABEL", "Sub-Regions");
define("WORDING_AJAX_REGIONAL_MENU1", "Filter By Your Region");
define("WORDING_AJAX_REGIONAL_MENU2", "Filter By State");
define("WORDING_AJAX_REGIONAL_MENU3", "Filter By City");

define("WORDING_AJAX_REGIONAL_REG_LABEL", "Sub-Regions");
define("WORDING_AJAX_REGIONAL_REG1", "Region");
define("WORDING_AJAX_REGIONAL_REG2", "State");
define("WORDING_AJAX_REGIONAL_REG3", "City");


define("REG_FORM_WELCOME_TITLE", "Thank You For Wanting To Add Your Link To Our Classified Cooperative!");
 define("REG_FORM_WELCOME_BODY", "<p align='left' style=\"color:black;\">Our's is one of a network of many on individually owned and operated websites that co-operate together to advertise each other\'s websites. Your website will be advertised not just on our own site but the entire network as well! It's a better way for us to help even more people find your website than what just our own site could provide you by itself.</p>
 <p  align='left' style=\"color:black;\">You will be provided more info about how you can add this great, free web directory later so you can become part of this bigger effort to make your website successful!");
 
 define("MESSAGE_WEBSITE_TITLE_EMPTY", "<h3>Website Title field was empty</h3>");
define("MESSAGE_WEBSITE_URL_EMPTY", "<h3>Website URL field was empty</h3>");
define("MESSAGE_WEBSITE_DESCRIPTION_EMPTY", "<h3>Website Description field was empty</h3>");
define("MESSAGE_WEBSITE_STREET_FULL", "<h3>Website Street field has info with no city selected</h33>");
define("MESSAGE_MAIN_CAT_EMPTY", "<h3>You didn't select a catageory</h3>");
define("MESSAGE_LOCATION_ID_EMPTY_STREET_FILLED", "<h3>The Website Street field has info with no city selected</h3>");
define("MESSAGE_WEBSITE_TITLE_BAD_LENGTH", "<h3>The Website Title field has too few or too many characters (6-64)</h33>");
define("MESSAGE_WEBSITE_DESCRIPTION_TOO_LONG", "<h3>The Website Description field has too many characters (255 max)</h3>");
define("MESSAGE_WEBSITE_URL_TOO_LONG", "<h3>The Website Description field has too many characters (255 max)</h3>");
define("MESSAGE_ACCOUNT_NOT_ACTIVATED", "<h3>Your account is not activated yet. Please click on the confirm link in the mail.</h3>");
define("MESSAGE_CAPTCHA_WRONG", "<h3>Captcha was wrong!</h3>");
define("MESSAGE_CATEGORY_ID_BAD", "<h3>Category ID was wrong!</h3>");
define("MESSAGE_LOCATION_ID_BAD", "<h3>Location ID wrong!</h3>");
define("MESSAGE_COOKIE_INVALID", "<h3>Invalid cookie</h3>");
define("MESSAGE_DATABASE_ERROR", "<h3>Database connection problem.</h3>");
define("MESSAGE_EMAIL_ALREADY_EXISTS", "<h3>This email address is already registered. Please use the \"I forgot my password\" page if you don't remember it.</h3>");
define("MESSAGE_EMAIL_CHANGE_FAILED", "<h3>Sorry, your email changing failed.</h3>");
define("MESSAGE_EMAIL_CHANGED_SUCCESSFULLY", "<h3>Your email address has been changed successfully. New email address is </h3>");
define("MESSAGE_EMAIL_EMPTY", "<h3>Email cannot be empty</h33>");
define("MESSAGE_EMAIL_INVALID", "<h3>Your email address is not in a valid email format</h3>");
define("MESSAGE_EMAIL_SAME_LIKE_OLD_ONE", "<h3>Sorry, that email address is the same as your current one. Please choose another one.</h3>");
define("MESSAGE_EMAIL_TOO_LONG", "<h3>Email cannot be longer than 64 characters</h3>");
define("MESSAGE_LINK_PARAMETER_EMPTY", "<h3>Empty link parameter data.</h3>");
define("MESSAGE_LOGGED_OUT", "<h3>You have been logged out.</h3>");
// The "login failed"-message is a security improved feedback that doesn't show a potential attacker if the user exists or not
define("MESSAGE_LOGIN_FAILED", "<h3>Login failed.</h3>");
define("MESSAGE_OLD_PASSWORD_WRONG", "<h3>Your OLD password was wrong.</h3>");
define("MESSAGE_PASSWORD_BAD_CONFIRM", "<h3>Password and password repeat are not the same</h3>");
define("MESSAGE_PASSWORD_CHANGE_FAILED", "<h3>Sorry, your password changing failed.</h3>");
define("MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY", "<h3>Password successfully changed!</h3>");
define("MESSAGE_PASSWORD_EMPTY", "<h3>Password field was empty</h3>");
define("MESSAGE_PASSWORD_RESET_MAIL_FAILED", "<h3>Password reset mail NOT successfully sent! Error: </h3>");
define("MESSAGE_PASSWORD_RESET_MAIL_SUCCESSFULLY_SENT", "<h3>Password reset mail successfully sent!</h3>");
define("MESSAGE_PASSWORD_TOO_SHORT", "<h3>Password has a minimum length of 6 characters</h3>");
define("MESSAGE_PASSWORD_WRONG", "<h3>Wrong password. Try again.</h3>");
define("MESSAGE_PASSWORD_WRONG_3_TIMES", "<h3>You have entered an incorrect password 3 or more times already. Please wait 30 seconds to try again.</h3>");
define("MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL", "<h3>Sorry, no such id/verification code combination here...</h3>");
define("MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL", "<h3>Activation was successful! You can now log in!</h3>");
define("MESSAGE_REGISTRATION_FAILED", "<h3>Sorry, your registration failed. Please go back and try again.</h3>");
define("MESSAGE_RESET_LINK_HAS_EXPIRED", "<h3>Your reset link has expired. Please use the reset link within one hour.</h3>");
define("MESSAGE_VERIFICATION_MAIL_ERROR", "<h3>Sorry, we could not send you an verification mail. Your account has NOT been created.</h3>");
define("MESSAGE_VERIFICATION_MAIL_NOT_SENT", "<h3>Verification Mail NOT successfully sent! Error: </h3>");
define("MESSAGE_VERIFICATION_MAIL_SENT", "<h3>Your account has been created successfully and we have sent you an email. Please click the VERIFICATION LINK within that mail.</h3>");
define("MESSAGE_USER_DOES_NOT_EXIST", "<h3>This user does not exist</h3>");
define("MESSAGE_USERNAME_BAD_LENGTH", "<h3>Username cannot be shorter than 2 or longer than 64 characters</h3>");
define("MESSAGE_USERNAME_CHANGE_FAILED", "<h3>Sorry, your chosen username renaming failed</h3>");
define("MESSAGE_USERNAME_CHANGED_SUCCESSFULLY", "<h3>Your username has been changed successfully. New username is </h3>");
define("MESSAGE_USERNAME_EMPTY", "<h3>Username field was empty</h3>");
define("MESSAGE_USERNAME_EXISTS", "<h3>Sorry, that username is already taken. Please choose another one.</h3>");
define("MESSAGE_USERNAME_INVALID", "<h3>Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters</h3>");
define("MESSAGE_USERNAME_SAME_LIKE_OLD_ONE", "<h3>Sorry, that username is the same as your current one. Please choose another one.</h3>");
define("MESSAGE_CONFIGURATION_STATUS_HEADING", "<h2 style='color:red;'>Configuration Status</h2>");
define("MESSAGE_RESEND_EMAIL1", "<h3 style='color:red;'>We were not able to detect that you have responded to the email verification email that we sent you.  We searched our database registrations for your website");
 define("MESSAGE_RESEND_EMAIL2", "and found it is registered as an advertiser in the Manna Network but the system is awaiting your verification of your email address. <b>You need to click the link in the email we sent you!</b>. <p>If for some reason you don't find the confirmation email in your inbox then be sure to check your spam folder (and, if there, be sure to whitelist emails from that sender in your email client).</h3> <h3 style='color:red;'>REMEMBER: The email will be sent from a Manna Network Authorized Agent (yours is ");
define("MESSAGE_RESEND_EMAIL3", " and you can verify their affiliate status with Manna Network at <a target=\"_blank\" href=\"https://manna-network.com/agents\">Manna-Network.com</a>).And, also, that Manna Network Authorized Agent also hosts your advertiser admin panel where you can:<ul><li>Add your listing to more categories</li><li>Add more websites</li><li>Bid for better placement</li><li>Check your earnings</li></ul></h3><h3 style='color:red;'>If you would like for the verification email to be resent then click the button below.</h3>");
define("MESSAGE_RESEND_EMAIL_BUTTON", "Resend Email Verification");
define("MESSAGE_RESEND_EMAIL_REFRESH", "<h3 style='color:red;'>After verifying email address, refresh this page.</h3>");
define("MESSAGE_NO_REGISTRATION_HEADING", "<h3 style='color:red;'> Site is not registered.</h3>");
define("SET_OPTIONS_SUCCESS", "<h2>Your configurations have been saved.</h2>");
define("SET_OPTIONS_REFRESH", "<h3>Please refresh the page</h3>");
define("CLEAR_OPTIONS_SUCCESS", "<h2>Your configurations have been cleared</h2>");
define("CLEAR_OPTIONS_REFRESH", "<h3>Please refresh the page to reset (be sure to click the \"Save\" button)</h3>");
define("CONFIGURATION_HEADING", "Configuration");
define("CONFIGURATION_FORM_MESSAGE1", "<h3 style='color:red;'>We have retrieved the following information about your website and inserted it in the form below for your convenience. <br>IMPORTANT! Correct information is essential for you to receive your commissions!<br> You are responsible to verify the accuracy of the info. The settings below should match those you view by logging into your advertiser's admin page/dashboard at");
define("CONFIGURATION_FORM_MESSAGE1R", "<h3 style='color:red;'><u><b>We have detected that the plugin is already registered!</b></u><br> We retrieved the following information about your website and inserted it in the form below for your convenience. <br>IMPORTANT! Submitting this form will overwrite your current settings! Correct information is essential for you to receive your commissions!<br> You are responsible to verify the accuracy of the info. The settings below should match those you view by logging into your advertiser's admin page at");
define("CONFIGURATION_FORM_MESSAGE2", "(then click the \"Settings\" button to see the stored settings for this ad/link)</h3>");

// views
define("WORDING_BACK_TO_LOGIN", "<h3>Back to Login Page</h3>");
define("WORDING_CHANGE_EMAIL", "<h3>Change email</h3>");
define("WORDING_CHANGE_PASSWORD", "<h3>Change password</h3>");
define("WORDING_CHANGE_USERNAME", "<h3>Change username</h3>");
define("WORDING_CURRENTLY", "<h3>currently</h3>");
define("WORDING_EDIT_USER_DATA", "<h3>Edit user data</h3>");
define("WORDING_EDIT_YOUR_CREDENTIALS", "<h3>You are logged in and can edit your credentials here</h3>");
define("WORDING_FORGOT_MY_PASSWORD", "<h3>I forgot my password</h3>");
define("WORDING_LOGIN", "Log in");
define("WORDING_LOGOUT", "<h3>Log out</h3>");
define("WORDING_NEW_EMAIL", "<h3>New email</h3>");
define("WORDING_NEW_PASSWORD", "<h3>New password</h3>");
define("WORDING_NEW_PASSWORD_REPEAT", "<h3>Repeat new password</h3>");
define("WORDING_NEW_USERNAME", "<h3>New username (username cannot be empty and must be azAZ09 and 2-64 characters)</h3>");
define("WORDING_OLD_PASSWORD", "<h3>Your OLD Password</h3>");
define("WORDING_PASSWORD", "<h3>Password</h3>");
define("WORDING_PROFILE_PICTURE", "<h3>Your profile picture (from gravatar):</h3>");
define("WORDING_REGISTER", "Register");
define("WORDING_REGISTER_NEW_ACCOUNT", "<h3>Register new account</h3>");
define("MESSAGE_WEBSITE_CATEGORY_EMPTY", "<h3>Please select the best category describing your website or business</h3>");
define("WORDING_REGISTRATION_TITLE", "<h3>Title - Please enter a description (a heading or title) for your website or business. It will be the heading for your listing</h3>");
define("WORDING_REGISTRATION_URL", "<h3>Domain Name/URL</h3>");
define("WORDING_REGISTRATION_PAGE_NAME","<h3>Create a page specifically for this ad?</h3>");
define("WORDING_REGISTRATION_DESCRIPTION", "<h3>Description - Enter a 50 to 255 character description of your website or business</h3>");
define("WORDING_REGISTRATION_CATEGORY", "<h3><b>Category (required) -</b> Select the BEST category for your website or business listing from among either main categories or subcategories (Hint: the higher the category, the more the competition).</h3>");

define("WORDING_CATEGORY_SUGGESTION", "Have a category suggestion for YOUR website? Enter it here and, if approved, we will add it and your listing there (instead of your LAST selected one*)!");

define("WORDING_REGISTRATION_LOCATION", "<h3><b>Location (optional) - </b>Locations will be used by the end users to \"filter\" to your listing from among irrelevant results outside their area.</h3>");
define("WORDING_REGISTRATION_STREET", "<h3>Street Address - <b>IF</b> you selected a city then, optionally, you can also add your street addess to your listing.</h3>");
define("WORDING_REGISTRATION_DISTRICT", "<h3>Add (optional) District, Boroughs, Regions, Neighborhood etc (optional) - Examples: Bronx, Lakes District, New England etc. (IF applicable) </h3>");
define("WORDING_REGISTRATION_RECIPROCAL_HEADER", "<h2>Earn Income From Reciprocal Linking (Optional)</h2><br>");
define("WORDING_REGISTRATION_RECIPROCAL", " 
<p style='text-align:left; color:black;'>After registration you can login to your dashboard and download and install our free web directory/classified ads script on your website with the following benefits:
<ul style='text-align:left; color:black;'><li>Receive 50% commissions* on whatever your registered advertisers ever spend for their advertising in the network. We give demo coins to every advertiser you register which generates Demo Coin commissions for you (enabling you to enjoy better position)  </li>
<li>You/we offer the same opportunity to earn to each of your advertisers! When they install the script, you get additional override commissions on their sales!</li>
<li>You receive commissions on your own purchases of better placement effectively getting a 50% member's discount on your own ad purchases</li>

</ul>
<p style='text-align:left; color:black;'>* Commissions earned as \"Demo Coin\" are spendable for advertising position ONLY and are transferable to other members. They are NOT backed nor redeemable for anything other than for better placement in the Manna Network. Commissions earned from ads purchased with BitcoinSV, on the other hand, are redeemable for BitcoinSV.</p>");




define("WORDING_TXTHINT1", "More After Selection");//x
define("WORDING_TXTHINT_2", "Still More");
define("WORDING_AJAX_MENU", "Select a Category (required)");
define("WORDING_AJAX_MENU1", "Select a Sub-Category");
define("WORDING_AJAX_MENU2", "A Deeper Sub-Category?");


define("SUMMARY_AJAX_HEADER", "<h4>The report below will be adjusted to reflect the bidding and competition in the category and/or location you selected. As a general rule, the higher the category or location, the lower your free link will be displayed or the more expensive the bid required to get better placement will be.</h4> ");
define("SUMMARY_AJAX_NUM_LINKS", "<p>Total links in the category: ");
define("SUMMARY_AJAX_FREE_PAGE_COUNT1", "<p>Your free link will begin being displayed on page ");
define("SUMMARY_AJAX_FREE_PAGE_COUNT2", " at the ");
define("SUMMARY_AJAX_FREE_PAGE_COUNT3", "  position. ");
define("SUMMARY_AJAX_MIN_DEMO_BID1", "<p>You will receive free \"Demo Coin\" to bid with in the amount of ");
define("SUMMARY_AJAX_MIN_DEMO_BID2", "<p>The minimum Demo Coin bid (enough to place your link ahead of all free links) is ");
define("SUMMARY_AJAX_MIN_BCH_BID1", " (per month). <p>There are ");
define("SUMMARY_AJAX_MIN_BCH_BID2", " BitcoinSV paying advertisers in this category. <p>The lowest BCH price (per month) is ");
define("SUMMARY_AJAX_MIN_BCH_BID3", "");
define("SUMMARY_AJAX_MIN_BCH_BID4", " (per month) <p> The hightest Demo Coin bidder currently is  ");
define("SUMMARY_AJAX_MIN_BCH_BID5", " (per month) <p>Price to acquire the top Demo Coin display position ");
define("SUMMARY_AJAX_MIN_BCH_BID6", " (per month).<p> The highest BitcoinSV bidder currently is  ");
define("SUMMARY_AJAX_MIN_BCH_BID7", " (per month) <p>Price to acquire the top BitcoinSV(i.e. overall # 1) display position: ");
define("SUMMARY_AJAX_MIN_BCH_BID8", " (BCH per month)");

define("MORE_INFO_PAGE", '<div  style="width: 500px;  margin-left: auto ;
  margin-right: auto ;">For <b>More Info</b> about the bidding system ');

define("MORE_INFO_PAGEEND", 'Click Here</a></div>');


define("WORDING_AJAX_FREE_POSITION0", "<ul><li><u><b>Free sites</b></u> are listed and ordered according to their seniority (i.e. the date/time they registered).
</li><li><u><b>\"Demo coins\"</b></u>  are given to each new listing in the ad network (you will receive ");



define("WORDING_AJAX_FREE_POSITION01", " demo coin) which can be used to <u>purchase better position</u>.</li><li><u><b>The site you registered at </b></u> will \"earn\" a 50% commission of the demo coin you spend. </li><li><u><b>The demo system</b></u> demonstrates not only how to bid for better position but also how websites with our API earn income from the subscribers they registered. They can, thus, maintain their own bidding positions just from the commissions of new recruits.
</li><li><u><b> Ads paid with BitcoinSV</b></u>  are even better. They are displayed ahead of both Demo paying ads and free ads.And like with the demo coin, the website where the advertiser registered at earn commission but this time in real money (i.e. cryptocurrency) that has value. They can still spend it to buy better positions or they can withdraw them as \"profit\" from their website! </li>");
define("WORDING_AJAX_FREE_POSITION1", "<li><u><b>Your free listing</b></u> will initially be positioned at the ");
define("WORDING_AJAX_FREE_POSITION2", " position which will be on page ");
define("WORDING_AJAX_FREE_POSITION3", ", position ");
define("WORDING_AJAX_DEMO_POSITION1", " of the category. If you use the free \"Demo Coin\" (which you will receive immediately after registration) to bid for better position, then the minimum bid (");
define("WORDING_AJAX_DEMO_POSITION1B", " demo coin) would move your listing ahead of all free links and up to position ");


define("WORDING_AJAX_DEMO_POSITION2", ", which will be on page ");
define("WORDING_AJAX_DEMO_POSITION3", ", position ");
define("WORDING_AJAX_DEMO_POSITION4", ", </li><li> There are already ");
define("WORDING_AJAX_DEMO_POSITION5", ", <u>advertisers</u> that have bid using their demo coin AND ");
define("WORDING_AJAX_DEMO_POSITION6", ", advertisers that have bid using BitcoinSV (for a total of ");
define("WORDING_AJAX_DEMO_POSITION7", " <b>advertisers that would still listed ahead of yours</b> if you bid the <u>minimum</u> with your free demo coin).</li><li><u><b> You can bid more </b></u>than the minimum with your Demo Coin and achieve higher positions among the Demo Coin group but your allotment won't last as long. </li><li><u><b>To maintain your Demo Coin balance</b></u> you can install our web directory app on your website and earn them from subscribers that register there (they each also receive demo coins when they register). You can also outbid them with even the minimum bid amount of BitcoinSV.</li><li><u><b> If you aren't familar with crypto currency</b></u> you can take our course at <a style='text-decoration:underline;color:blue;' target='_blank' href='http://bitcoin101.today'>Bitcoin101.today</a> for just $1.01.</li> ");
define("WORDING_AJAX_DEMO_POSITION8", "<li><u><b>The highest \"Demo Coin\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_DEMO_POSITION9", " for their top position among the Demo Coin group. It will cost you one-and-a-half times that to claim #1 of the Demo Coin bidders ");

define("WORDING_AJAX_BCH_POSITION1", "</li><li><u><b>The highest \"BitcoinSV\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_BCH_POSITION2", " for their top position of all. It will cost you one-and-a-half times that to claim #1 of the BCH bidders  ");
define("WORDING_AJAX_BCH_POSITION3", "</li><li><u><b>The lowest \"BitcoinSV\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_BCH_POSITION4", " for their bottom position (lowest to be ahead of all demo coin and free ads).</li></ul> ");
define("WORDING_AJAX_BCH_POSITION5", "<li><u><b>The lowest \"Demo Coin\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_BCH_POSITION6", " for their bottom position (lowest to be ahead of all free ads).</li>");

define("WORDING_AJAX_EXPANDED_REPORT_HEADER","<h4>Your Present Ad Position Would BE (expanded)...</h4>"); 

define("WORDING_AJAX_SUMMARY_REPORT_HEADER","<h4>Your Present Ad Position Would BE (summary) ...</h4>"); 


define("WIDGET_INSTALL_LOCATION", "<h3>After installion, enter the location here to activate commissions (optional):</h3>");
define("WIDGET_BITCOINSV_ADDRESS", "<h3><b>After installion</b>, you will need a BitcoinSV address address to receive earnings (An example of a Bitcoin/BitcoinSV address - 1BvBMSEYstWetqTFn5Au4m4GFg7xJaNVN2) where your commission earnings can be sent (upon request). Need to learn about this? Need a BitcoinSV wallet? Take the beginner course below. </h3>");
define("WIDGET_SOFTWARE_LINKS", "<h3>Reciprocal Linking - Get your reciprocal linking software from the links below!</h3>");

define("WORDING_REGISTRATION_CAPTCHA", "<h3>Please enter these characters</h3>");
define("WORDING_REGISTRATION_EMAIL", "<h3>Email - Please provide a real email address! You'll get a verification mail with an activation link (your ad/link will not be displayed without a response).</h3>");
define("WORDING_REGISTRATION_PASSWORD", "<h3>Password - (min. 8 characters and must contain at least 1 upper case, one number and one character!)</h3>");
define("WORDING_REGISTRATION_PASSWORD_REPEAT", "<h3>Password (again)</h3>");
define("WORDING_REGISTRATION_USERNAME", "<h3>Username (only letters and numbers, 2 to 64 characters)</h3>");
define("WORDING_REMEMBER_ME", "<h3>Keep me logged in (for 2 weeks)</h3>");
define("WORDING_REQUEST_PASSWORD_RESET", "<h3>Request a password reset. Enter your username and you'll get a mail with instructions:</h3>");
define("WORDING_RESET_PASSWORD", "<h3>Reset my password</h3>");
define("WORDING_SUBMIT_NEW_PASSWORD", "<h3>Submit new password</h3>");
define("WORDING_USERNAME", "<h3>Username</h3>");
define("WORDING_YOU_ARE_LOGGED_IN_AS", "<h3>You are logged in as </h3>");
//located on the plugin's Manna Network admin in the dashboard
define("ADMIN_PAGE_NAME", "After verifying the accuracy of the configurations automatically detected and entered above, locate and enter the name of the page that you entered the Manna Network shorttag on. Hint: If you are new to Wordpress do a Quick read on \"Permalinks\" (which is Wordpress's method to make the links \"pretty\" for users and search engine friendly )");
define("REGISTRATION_CAT_HEADING", "Select Category");
define("REGISTRATION_REGIONAL_HEADING_SEL", "<h4>Select A Location (OPTIONAL)</h4>");
define("REGISTRATION_GENERAL_ERROR1", " entry error ... ");
define("REGISTRATION_GENERAL_ERROR2", " Current value: ");
define("REGISTRATION_LNK_NUM1", "You must supply the link number of the recruiter (You can find it by logging in to your advertiser dashboad, click the \"Get Better Placement\" button).");
define("REGISTRATION_LNK_NUM2", "Must be non negative integer.");
define("REG_BLOKT_CATEGORY_MESSAGE", "<p>CATEGORY</p>
<p>The category you select affects your ad campaign results. You
should (as a rule) select the highest (but most descriptive) that you
can UNLESS there is so much competition there from other advertisers
that you will be too low in the display. If that is the situation you
can select a lower level category (which should also be more specific
to your business, service or blog topic) and you will face far less
competition. You can also bid for better placement using either \"DEMO COIN\" (a supply of them will be credited to you) or with BitcoinSV.</p>");
define("REG_BLOKT_CATEGORY_MOUSEOVER", "Category Selection Help");
define("REG_BLOKT_REGIONAL_MESSAGE", "<p>Regional Filtering</p>
<p>The main purpose for the regional option is to enable the END USER
(sic. The Internet users viewing the ads) to filter out ad results
from unwanted locations and find advertisers. Some businesses don’t
draw customers from any specific region or location so they can leave
this option empty. The way it works is the viewer selects the
location they want to limit the results to. Only listings in a
country selected will appear, for example (but results from all fifty
states in the USA would also appear) but if the viewer selects a
specific state (or city) then only those will appear..</p>");
define("REG_BLOKT_REGIONAL_MOUSEOVER", "Regional Selection Help");
define("WORDING_PROTOCOL_TITLE", "<h3>Select Current Protocol</h3>");
define("PROT_BLOKT_TITLE_MOUSEOVER","An SSL protected site (sic. uses \https://\") is very strongly recommended (and it helps your SEO too!)");
define("PROT_BLOKT_TITLE_MESSAGE","An SSL protected site (sic. uses \https://\") is very strongly recommended (and it helps your SEO too!)");
define("REG_BLOKT_URL_MESSAGE", "<p>ENTER YOUR DOMAIN NAME</p>
<p>No https://, http://, or www.</p><p>For an explanation, Google \"Is www. in a url necessary or helpful?\"</p>");
define("REG_BLOKT_URL_MOUSEOVER", "URL/Domain Name Help");
define("REG_BLOKT_URL_INPUT_MESSAGE", "Insert Your Domain Name URL HERE");
define("REG_BLOKT_PAGE_MESSAGE", "<p>CREATE A LANDING PAGE</p>
<p>It is strongly suggested you create a landing page so that you can
better track the results from the Manna Network. Note, it doesn’t
have to be unique content (because we have a No Index/No Follow meta
tag on the directory to avoid duplicate content search engine
problems). You can do something as simple as making a duplicate of
your home page (with a different file/page name of course) and entering that
PAGE here. To track the results of the advertising campaign go into
your own stats software (example: AWStats in CPanel) to see how much
traffic you are receiving from the ad network (you can be pretty
certain the traffic came from the ad network if the only links to
that page are the ones in the ad network, right?).</p>
<p>This is especially important to merchants who place ads in the \"Deals\" category (they must create a page specifically for the deal(s) they are offering)</p>");
define("REG_BLOKT_PAGE_MOUSEOVER", "Landing Page Help");
define("REG_BLOKT_PAGE_INPUT_MESSAGE", "Insert Your LANDING PAGE NAME HERE (optional)");
define("REG_BLOKT_DESCRIPTION_MESSAGE", "<p>Add An Ad Description</p>
<p>Try to come up with an exciting and interesting GENERAL
description of your main goods, services or blog topic. Attention
e-commerce sites: DO NOT add individual products (the ad will be
rejected without notice).</p>");
define("REG_BLOKT_DESCRIPTION_MOUSEOVER", "Description Help");
define("REG_BLOKT_PASSWORD_MESSAGE", "<p>Password</p>
<p>Create a VERY secure password for your account. That is important
because the Manna Network uses a crypo-currency payment system and it
draws hackers (at your control panel login). Use a secure password to
keep anyr funds safe .</p>");
define("REG_BLOKT_PASSWORD_MOUSEOVER", "Password Help");
define("REG_BLOKT_EMAIL_MESSAGE", "<p>Use A Valid Email Address</p>
<p>You will be sent a verification email before your ad will be
processed. It also gives you access to your Control Panel where you
can add more ads, edit existing ads and bid for better position. 
</p>");
define("REG_BLOKT_EMAIL_MOUSEOVER", "Email Info");
define("CONFIG_BLOKT_PGNAME_TITLE","Your Page Name/Slug Info");
define("CONFIG_BLOKT_PGNAME_MESSAGE", "<p>Enter The Name Of The Page(also known as the slug) That Displays The Directory On Your Website</p>
<p>This is optional (or can be edited later) but adding the page name helps build your customer base. The Manna Network website posts the websites of its members so that new advertisers can choose one to register at. Adding your page name makes the Manna Network posted link go directly to your directory page and makes it easier for new advertisers to find YOUR registration page.</p>");
define("CONFIG_BLOKT_PGNAME_MOUSEOVER", "Page Name/Slug Info");
define("CONFIG_BLOKT_MEETUP_TITLE","Start A Meetup!");
define("CONFIG_BLOKT_MEETUP_MESSAGE", "<p>A great way to build your Manna Network \"downline\" is to start a <a target=\"_blank\" href=\"meetup.com\">Meetup (see Meetup.com)</a> in your local area! </p><p>&nbsp;</p><p>Meetups are a great way for potential advertisers and members to learn such things as web advertising, website monetization, Bitcoin, how to use and operate the Manna Network system etc.</p><p>&nbsp;</p><p>IF you start a Meetup be sure to add the link to it here so that The Manna Network can help promote it!</p>");
define("CONFIG_BLOKT_MEETUP_MOUSEOVER", "Meetups are a great way for potential advertisers and members to learn!");
define("REG_BLOKT_TITLE_MESSAGE","<p>ADD AN AD TITLE</p>
<p>Create something exciting and descriptive about your business or
website. Try to make it eye-catching and informative about the goods
or services you provide or, if yours is a blog site then enter
something describing your main topic.</p>");
define('CONFIG_BLOKT_CONTACT_TITLE','Create A Contact Form(Optional');
define('CONFIG_BLOKT_CONTACT_MOUSEOVER','CREATE A CONTACT FORM');
define('CONFIG_BLOKT_CONTACT_MESSAGE','<p>(Optional) If you would like web directory visitors to contact you with questions then we can create a "Contact Us" page for your directory. You can insert either a shorttag of your Wordpress "contact" plugin or your email address and we will create the page for your web directory');

define("REG_BLOKT_TITLE_MOUSEOVER", "Title Hint");

define("NO_CONFIG", '<h1>Click the "Manna Network" link in your Dashboard to configure the plugin. </h1>');
define("NO_LINK_QUERY_RESULTS", '<div style="width: 50%;  margin: auto;  border: 3px solid #4287f5;  font-size: 2em;   background-color: chartreuse;">Sorry, No Links/Ads found in this category. Try another or a "higher" or more general category...</div>');
define("NO_LINK_QUERY_RESULTS_REGIONAL", '<div style="width: 50%;  margin: auto;  border: 3px solid #4287f5;  font-size: 2em;   background-color: chartreuse;">Sorry, No Links/Ads found in this category/location. Try another "higher" or more general category and/or location...</div>');
define("NO_REGISTRATION1", "<h2>Configuration Status</h2><h3 style='color:red;'>We were not able to detect that your website ");
define("NO_REGISTRATION2"," is registered as an advertiser in the Manna Network (which is required in order for you to configure the plugin). 
</h3>
<h3 style='color:red;'>If you found and downloaded the plugin from one of our members or found out about the Manna Network from one then, please, register at that member site (visit their site, find their Manna Network display page and click the \"Add URL\" link)!</h3>
<h3>Otherwise, you can find a member site to register at <a href='https://manna-network.com/register'>https://Manna-Network.com/register</a></h3>
<h3>Registration is free!</h3>
<h3>AND it will send traffic to your website from the growing network of other websites using the plugin!</h3>
<h3>After registering, refresh this page.</h3>");
