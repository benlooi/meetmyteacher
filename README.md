# meetmyteacher
An appointment booking portal for school

This is an introductory coding project for school students learning to code.
Requires working knowledge of HTML, CSS and Javascript.

Students will be introduced to a framework like AngularJS, as well as management tools like Github and bower.

Instructor will hand-hold and scaffold the project by providing a "template" and proposed structure to get the students started. S
Students can then fork their own versions, exchange ideas and notes, and gain experience in coding.

This is open-source and licensed under the DWUW or DO WHATEVER U WANT license. You can copy and use it in any way you like. I really don't care.


#Proposed concept:
No log in required at the beginning, so students can have quick access and less barriers to get help for school work by finding 
teachers who are available to give coaching. Teachers also can better manage their time by making available certain time 
slots for open consultations. Only when booking the selected time slot, the user needs to log in.

Hence, some routing and permissions checking is required at certain stages.

#Database set up
MySQL can be used. We have included a suggested CodeIgniter sample for simple logging in and slot creation by teacher. The tables that are needed are as follows, although, you may have a better way to organise your data.
USERS 
- user_id (PRIMARY KEY, A.I)
- fname
- lname
- username
- password
- role
- class
- subjects
- status
- email

SLOTS
- slot_id (PRIMARY, AI)
- date
- start_time
- teacher_id
- student_id
- subject
- status
