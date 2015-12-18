# CSCI E-15, P4, Kar Ho Lau

## Live URL
<http://p4.orangeedward.xyz>

## Description
The final assignment, P4, a room reservation application. This app will allow each user to see room availabilities, request a room for event, managed room reservations. 

An administrator role has the ability to manage users, add new rooms & timeslots, approve or deny a room request. 

A member role has the ability to manage his/her own profile, deleting themselves, requesting for a room reservation. 


## Demo
[http://screencast.com/t/lSPn0JBU7Lp](http://screencast.com/t/lSPn0JBU7Lp)

There are so many things that I would love to demo, but there are just so little tiem to fit it all in. Please feel free to ask me any questions you may have. 

## Details for teaching team
1. jill@harvard.edu (password as Susan instructed.)
  - this is a normal user account. 

2. jamal@harvard.edu (same on the password situation)
  - this is an admin account that has access to everything. 

## Each Tabs and Tables
1. **User's Profile and Users**:
  - Update User's information. 
  - created a specific password page for user to update their password, with Hash function and compare the current password before committing to change to the new password. 
  - Users List view for Admin to manage user and softDelete an user it's necessary. 

2. **Rooms**:
  - Admin has the privilege to create and add new rooms. And admin can also update and delete a room. 
  - Viewing from the whole list of rooms, Members can tell see the reservations under that individual room. There's a button to view ALL reservations vs. UPCOMING ONLY. 

3. **Timeslots**:
  - Admin has the privilege to create and add new timeslots. And admin can also update and delete a timeslot. 
  - From this timeslots list, user is in a read-only mode. user can see what is available for them. And by clicking on the room's name, it will bring the user to a reservation page to create a reservation for that room.

4. **Reservations**:
   - Admin has the authority to create, update and delete a reservation request, as well as to approve and reject a request. 
  - User has the access to create a reservation, modify it and also softDelete it. 

## CSS
* **main.css** includes general items that needs styling, with a couple of `!important` added to override the default setting from Bootstrap

## Laravel packages used
* [fzaninotto/faker](https://packagist.org/packages/fzaninotto/faker)

## Outside code
* **Bootstrap**: [http://getbootstrap.com/](http://getbootstrap.com/) is used responsive page layout and handles all CSS for the forms.
* **Google Font API**: [Lato](https://www.google.com/fonts#QuickUsePlace:quickUse/Family:Lato)