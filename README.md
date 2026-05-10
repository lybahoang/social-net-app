New features in the SocialNet Project:

    1. The file db.php contains function to execute SQL statements and queries for code refactoring.

    2. Additional feature for "Friendship":
        Note 1. A new table named "friendship" is created to represent frienships. The SQL code for creating the table is in the file db.sql
            - The fields in the table: account_id_1, account_id_2, and status (pending/friend).
            - When a friend request is sent, the table adds one line, in which the sender's id is in account_id_1 and the receiver's id is in account_id_2, and status is 'pending'.
            - When a friend request is accepted, the table updates the line by setting status to 'friend'.
            - When a friend request is not accepted, the table deletes the line.
            - When a friendship is removed, the table deletes the line.

        Note 2. Additional specifications for pages:
            a. Home Page:
                - The Home Page shall display three categories of users: Friends, Requesting Users, and Strange Users.
    
                - The Friends list contains other users in the network that are friends of the current user. For each friend, the current user can do either of the following actions
                    + "View Profile" to view the profile of a friend.
                    + "Unfriend" to remove friendship with a friend.

                - The Requesting Users list contains requests from other users, who want to make friend with the current user. The current user can do either of the following actions:
                    + "Accept" to accept the request.
                    + "Do not accept" to not accept the request.

                - The Strange Users list contains other users in the system, including strange users and users who the current user has sent a friend request to.
                    + The current user can click on the button "Add friend" to send a request to another user.
                    + When a request is sent, the status changes to "Pending" and the current user can click on the button "Undo" to recall the request.

        Note 3. Additional code files
            a. /socialnet/friendship/add_friend.php:
                - The file handle the logic for friend request sending.
                - Query string: ?targetID=some_id
                - Description:
                    + It accepts a query string that contains "targetID" to specify the user that the current user sends a request to. If no query string exists, redirect to home page.
                    + It queries for the current user's id.
                    + It adds a new line to the "friendship" table with account_id_1=current_user_id, account_id_2=targetID, and status="pending"

            b. /socialnet/friendship/accept_friend.php:
                - The file handle the logic for friend request acceptance.
                - Query string: ?requesterID=some_id
                - Description:
                    + It accepts a query string that contains "requesterID" to specify the user who sent the friend request to the current user. If no query string exists, redirect to the home page.
                    + It queries for the current user's id.
                    + It updates the line in the "friendship" table with account_id_1=requesterID, account_id_2=current_user_id, status="friend".

            c. /socialnet/friendship/unfriend.php:
                - The file handle the logic for remove a friend.
                - Query string: ?friendID=some_id.
                - Description:
                    + It accepts a query string that contains "friendID" to specify a friend that the current user wants to remove. If no query string exists, redirect to the homepage.
                    + It queries for the current user's id.
                    + It deletes the line in the "friendship" table where
                        account_id_1=current_user_id, account_id_2=friendID, status='friend' OR
                        account_id_1=friendID, account_id_2=current_user_id, status='friend'

            d. /socialnet/friendship/reject_friend_request.php
                - The file handle the logic for "do not accept a friend request from another".
                - Query string: ?requesterID=some_id
                - Description:
                    + It accepts a query string that contains "requesterID" to specify a user that the current user want to not accept friend request. If no query string exits, redirect to the home page.
                    + It queries for the current user's id.
                    + It deletes the line in the "friendship" table where
                        account_id_1=requesterID, account_id_2=current_user_id, status='pending'.

            e. /socialnet/friendship/undo_friend_request.php
                - The file handle the logic for "undo a friend request sent by the current user to another user".
                - Query string: ?targetID=some_id
                - Description:
                    + It accepts a query string that contains "targetID" to specify a user that the current user want to undo the friend request. If no query string exits, redirect to the home page.
                    + It queries for the current user's id.
                    + It deletes the line in the "friendship" table where
                        account_id_1=current_user_id, account_id_2=targetID, status='pending'.
