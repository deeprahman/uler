"# uler" 
An Web app, built using php, javascript.
User can log in and log out(auto).
Report Arrival time via email
Report departure time via email
Upload photos.

How to Start(For development)?
Step1: Crate an user nammed uler.
Step2: Run the database.sql from line 1 to 65.
        The line admin_email = 'dp.rahman@hotmail.com' contains the
        email address for admin, the app will send email to this address
        You may change this to your convenience.
 Step3: Run the app using PHP version greater than or equal to 7.2.
         If every thing is ok you shall land in the Login page. Currently only
         One user in the data base, the admin user;
 Step4: Select the Radio button Called Admin and enter the following info
         User Name: deep  
         Password : 123456
          If you submit those everything goes fine, you should arrive to the 
          Add an employee page;
  Step4: Fill out the 'Add an employee' form completely, left no field empty;
         As it is a test process, you can use gibberish(Like- Firstname: wieosdhdh) to fill out the form.
         But, the email address should follow the convention (like: sffdf@gibberish.com) 
         You should remember the Employee username and password, Because we will be needing those.         
         (Right now there is no restriction for Username and Password length )
   Step5: Submit the form and close the browser.(Currently there is no logout button)
   
   How to use the App for putting timestamps(Arrival and Departure),
    informing via email and upload phptos(Development purpose)?              
   Step1: Restart the app, and you will be arrived on the Login page.
   Step2: Login as an Employee; use the username and password you have put while filling the Add Employee form.
          If everything goes fine, you will be logged in as an employee.
    Step3: After logging in you shall be given three options
           (a)Put an arrival time stamp
           (b)Put an departure time stamp
           (c)Upload some photos.
           The arrival and the departure timestamp put the current Date and Time in the database and Alert
            the admin via email.
            Upload some photos let you upload photos also .txt files. Uploaded files get new names which helps avoid overwriting
             a previously uploaded file; Login page offers protection against SQL Injection Attack. 
       
       Remember, the app is still in the development process, so it may look ugly now, but the underline logic
       is solid enough to put it to the test. Log out button and moving among pages are yet to be activated.                   
