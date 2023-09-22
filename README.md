# NEC_RegistrationApp
Test application for basic php application

Hello Team,
I'm adding few points related to the application just to provide a general idea of how things are implemented. 
1. DataBase Name : necprojectdb
2. Table Name : user_details
3. Table script :
CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `photo_link` varchar(255) DEFAULT NULL,
  `document_link` varchar(255) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
*******************************************************************************************************************
 1. Application url on local : http://localhost/NEC_RegistrationApp-main/
 2. The landing/index page has Home,Contact and Login options.
 3. If the user is already registered, he can login with his credentials OR we have a Register link where in they can create their account.
 4. Once the user Registers and Logs-In they will be redirected to their MyAccount tab where in they can update their details such as photo or other document. Or they can view theirentire profile.
The following are maintained in code level
1. Validations for all fields forlogin and register
2. Validations for photo and document upload
3. Session values
The screesnshots for same are attatched in the mail for reference.
    
