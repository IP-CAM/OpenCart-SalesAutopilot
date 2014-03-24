=========================================================================
SalesAutopilot integration for OpenCart v1.5.x
Author: Gyorgy Khauth
Author Email: gykhauth@salesautopilot.com

=========================================================================
Description
=========================================================================
This module sends orders to a SalesAutopilot order list.

=========================================================================
Compatibilities
-------------------------------------------------------------------------
- opencart v1.5.x 
- vqmod 2.4.0+ required

=========================================================================
Installation Instruction
=========================================================================
Step 1:
Copy the admin,catalog,vqmod folders to your store's top level directory, 
preserving the directory structure.

Step 2:
Log into your OpenCart 'Administration'. 
Go to 'Extensions' -> 'Modules'
Click 'Install' for 'SalesAutopilot'
Click 'Edit' for 'SalesAutopilot'
Change 'Status' to 'Enabled'
Login to your SalesAutopilot account and go to 'Settings' -> 'Integrations' 
-> 'API keys' 
Copy the Username from SalesAutopilot into the 'API Username' field, copy 
Password into the 'API Password' field.
Then in SalesAutopilot select the order list in the left tree menu which
you want to integrate with OpenCart. Then select a form of the list.
From the bottom of the form review screen copy the List ID to the 'Order 
List ID' field, the Form ID to the 'Form ID' field in Opencart.
Enable Debug if you experience any trouble. It helps us to solve the problem.
Click 'Save'