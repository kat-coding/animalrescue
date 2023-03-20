# animalrescue
A website for a fictional animal shelter. 
## Team Members
Kat Watkins, Alex Brenna, Dee Brecke.


## Separates all database/business logic using the MVC pattern.
1(database): database logic is in Datalayer file in model folder  
1(business): business logic is in the controller file in the controller folder and the index page
## Routes all URLs and leverages a templating language using the Fat-Free framework.
2:This is done in the controller file in the controller folder and the index page
## Has a clearly defined database layer using PDO and prepared statements. 
3: is in Datalayer file in model folder
## Data can be added and viewed.
4: is in Datalayer file in model folder 

4(add): addshelterpet.html, lostpet.html 

4(view): misspostinfo.html, missing.html, adoptable.html  
## Has a history of commits from both team members to a Git repository. Commits are clearly commented.
5: this can be view on github. Also, we have a timetracker.md file in which we documented any time that we worked together that will only show as one person committing to github.
## Uses OOP, and utilizes multiple classes, including at least one inheritance relationship.
6: this is handled in the classes folder

6(parent): Pets

6(kids): ShelterPet, LostPet 

ERD below shows that we structured our database to reflect the class inheritance. The fields are the same except the added keys.
<img src="data .png" alt="DB" title="DB Diagram">
## Contains full Docblocks for all PHP files and follows PEAR standards.
7: Each page had a doc header and any methods within a page have a description doc. Functions and logic differ as per PEAR standards
## Has full validation on the server side through PHP.
8:this is done on the validate.php in the model folder.
8(used): called with in the controller
It also has client side validation in the validate.js file in the model folder
## All code is clean, clear, and well-commented. DRY (Don't Repeat Yourself) is practiced.
9: We believe it is as clean as we can make it...
## Your submission shows adequate effort for a final project in a full-stack web development course.
10: We believe it does. we think he hit all the required marks. We each put a considerable amout of time, effort and care into this project
## BONUS:  Incorporates Ajax that access data from a JSON file, PHP script, or API. If you implement Ajax, be sure to include how you did so in your readme file.
## Admin Log-in ##

Username: syntaxians

Password: catdog 


