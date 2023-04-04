-- -----------------------------------------------------
-- Table `Accounts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Accounts` (
  `UserID` INT NOT NULL AUTO_INCREMENT,
  `FirstName` VARCHAR(45) NOT NULL,
  `LastName` VARCHAR(45) NOT NULL,
  `StartYear` INT NULL,
  `GraduationYear` INT NOT NULL,
  `Email` VARCHAR(45) NULL,
  `Acctype` VARCHAR(45) NULL,
  `Major` VARCHAR(45) NULL,
  `Minor` VARCHAR(45) NULL,
  `Employer` VARCHAR(45) NULL,
  `JobTitle` VARCHAR(45) NULL,
  `Password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`UserID`));


-- -----------------------------------------------------
-- Table `Events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Events` (
  `idEvents` INT NOT NULL AUTO_INCREMENT,
  `EventDate` VARCHAR(45) NOT NULL,
  `EventLocation` VARCHAR(45) NULL,
  PRIMARY KEY (`idEvents`));


CREATE TABLE IF NOT EXISTS `Message` (
  `MessageText` VARCHAR(120) NOT NULL,
  `Accounts_UserID_Sender` INT NOT NULL,
  `MessageTime` DATETIME NOT NULL,
  `Accounts_UserID_Receiver` INT NOT NULL,
  PRIMARY KEY (`Accounts_UserID_Sender`, `MessageTime`, `Accounts_UserID_Receiver`),
    FOREIGN KEY (`Accounts_UserID_Sender`)
    REFERENCES `Accounts` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`Accounts_UserID_Receiver`)
    REFERENCES `Accounts` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- -----------------------------------------------------
-- Table `Accounts_Attending`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Accounts_Attending` (
  `Events_idEvents` INT NOT NULL,
  `Accounts_CNUID` INT NULL,
  PRIMARY KEY (`Events_idEvents`, `Accounts_CNUID`),
  FOREIGN KEY (`Events_idEvents`)
  REFERENCES `Events` (`idEvents`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY (`Accounts_CNUID`)
  REFERENCES `Accounts` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `mydb`.`Post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Post` (
  `PostID` INT NOT NULL AUTO_INCREMENT,
  `UserID` INT NOT NULL,
  `PostTime` DATETIME NULL,
  `PostText` VARCHAR(400) NULL,
  `CommID` INT NOT NULL,
  PRIMARY KEY (`PostID`, `UserID`, `CommID`),
  CONSTRAINT `UserID`
    FOREIGN KEY (`UserID`)
    REFERENCES `mydb`.`Accounts` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `CommID`
    FOREIGN KEY (`CommID`)
    REFERENCES `mydb`.`Community` (`CommID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)


-- -----------------------------------------------------
-- Table `Community`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Community` (
  `CommID` INT NOT NULL AUTO_INCREMENT,
  `CommName` VARCHAR(45) NOT NULL,
  `PCSEAffiliate` VARCHAR(45) NULL,
  `YearCreated` INT NOT NULL,
  `MemberCount` INT NOT NULL,
  `PostCount` INT NULL,
  PRIMARY KEY (`CommID`));


-- -----------------------------------------------------
-- Table `Accounts_in_Comm`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Accounts_in_Comm` (
  `Accounts_CNUID` INT NOT NULL,
  `Community_idCommunity` INT NOT NULL,
  PRIMARY KEY (`Accounts_CNUID`, `Community_idCommunity`),
  FOREIGN KEY (`Accounts_CNUID`)
  REFERENCES `Accounts` (`UserID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  FOREIGN KEY (`Community_idCommunity`)
  REFERENCES `Community` (`CommID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `Report_System`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Report_System` (
  `RepSys_ID` INT NOT NULL AUTO_INCREMENT,
  `ReporterEmail` VARCHAR(250) NOT NULL,
  `DropType` VARCHAR(45) NOT NULL,
  `Detail` VARCHAR(250) NULL,
  `Status` VARCHAR(45) NOT NULL, 
  PRIMARY KEY (`RepSys_ID`, `ReporterEmail`));


-- -----------------------------------------------------
-- Table `mydb`.`Report_Other`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Report_Other` (
  `RepOth_ID` INT NOT NULL,
  `ReporterEmail` VARCHAR(250) NOT NULL,
  `DropType` VARCHAR(45) NOT NULL,
  `Detail` VARCHAR(250) NULL,
  `Rep_Acc_ID` INT NULL,
  `Rep_Comm_ID` INT NULL,
  `Rep_Mess_ID` INT NULL,
  `Rep_Post_ID` INT NULL,
  `Reason` VARCHAR(250) NULL,
  `Status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`RepOth_ID`),
    FOREIGN KEY (`Rep_Acc_ID`)
    REFERENCES `Accounts` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Rep_Comm_ID`
    FOREIGN KEY (`Rep_Comm_ID`)
    REFERENCES `Community` (`CommID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Rep_Mess_ID`
    FOREIGN KEY (`Rep_Mess_ID`)
    REFERENCES `Message` (`Accounts_UserID_Sender`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Rep_Post_ID`
    FOREIGN KEY (`Rep_Post_ID`)
    REFERENCES `Post` (`PostID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- -----------------------------------------------------
-- Table `Comm_Requests`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Comm_Requests` (
  `request_ID` INT NOT NULL AUTO_INCREMENT,
  `CommName` VARCHAR(45) NULL,
  `PCSEAffiliate` VARCHAR(45) NOT NULL,
  `Accounts_UserID` INT NOT NULL,
  `Reason` VARCHAR(250) NULL,
  PRIMARY KEY (`request_ID`, `Accounts_UserID`),
    FOREIGN KEY (`Accounts_UserID`)
    REFERENCES `Accounts` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);