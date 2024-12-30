# Atwix_CustomerRegistration module

## Customer Registration Flow Extension
This extension modifies the customer registration flow by implementing automatic whitespace removal from customer first names and additional post-registration actions.

---

## Features
- Automatically removes whitespaces from the customer's **First Name** during registration.
- Logs customer registration data to a dedicated log file.
- Sends notification emails to Customer Support after successful registration.

---

## Functionality Details

### First Name Whitespace Removal
- The module integrates with the customer registration process to automatically strip any whitespace characters from the **First Name** field before saving the customer entity.
- This process is executed **server-side** to ensure enhanced security and consistent data quality.

### Logging
- Upon successful registration, the module logs key customer information in the file `var/log/atwix/customer_registration.log`. The logged data includes:
   - Registration date and time.
   - Customer first name.
   - Customer last name.
   - Customer email address.

### Email Notifications
- The extension generates a notification email that is sent to the configured **Customer Support email address**. The email contains:
   - Customer first name.
   - Customer last name.
   - Customer email address.
 
---

## Technical Specifications

### Requirements
- **Magento**: 2.4.x
- **PHP**: 8.0 or higher

---
