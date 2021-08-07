Create Database Seun;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT, 
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ClientInformation` (
  `clientInfoId` INT(11) AUTO_INCREMENT,
  `FullName` varchar(50), 
  `Address1` varchar(100), 
  `Address2` varchar(100), 
  `City` varchar(100),
  `State` varchar(2),
  `ZipCode` varchar(9),
  `date_time` date NOT NULL,
  `userId` INT(11),
	PRIMARY KEY(`clientInfoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `fuel_qoute` (

  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Gallons` Float NOT NULL,
  `Delivery_Address` varchar(255) NOT NULL,
  `Delivery_Date` date, 
  `Suggested_Price_Per_Gallon` Float, 
  `Total_Amount_Due` Float, 
  `userId` INT(11),
  PRIMARY KEY(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

Database is created/


- Fuel Quote Form with following fields: (We are not building pricing
module yet)
- Gallons Requested (numeric, required)
- Delivery Address (Non-editable, comes from client profile)
- Delivery Date (Calender, date picker)
- Suggested Price / gallon (numeric non-editable, price will be calculated by Pricing Module - we are not building pricing module yet)
- Total Amount Due (numeric non-editable, calculated (gallons * price))


- Fuel Quote History
- Tabular display of all client quotes in the past. All fields from
Fuel Quote are displayed.
- You should have validations in place for required fields, field types,
and field lengths.