-- -----------------------------------------------------
-- Table `Accounts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Accounts` (
  `UserID` INT NOT NULL,
  `FirstName` VARCHAR(45) NOT NULL,
  `LastName` VARCHAR(45) NOT NULL,
  `StartYear` INT NOT NULL,
  `GraduationYear` INT NOT NULL,
  `Email` VARCHAR(45) NULL,
  `Acctype` VARCHAR(45) NULL 'should be determined student or alumni\n',
  `Major` VARCHAR(45) NULL COMMENT ,
  `Minor(s)` VARCHAR(45) NULL,
  `Employer` VARCHAR(45) NULL,
  `JobTitle` VARCHAR(45) NULL,
  `Password` VARCHAR(45) NOT NULL
  PRIMARY KEY (`UserID`));


-- -----------------------------------------------------
-- Table `mydb`.`Events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Events` (
  `idEvents` INT NOT NULL,
  `EventDate` VARCHAR(45) NOT NULL,
  `EventLocation` VARCHAR(45) NULL,
  PRIMARY KEY (`idEvents`));


-- -----------------------------------------------------
-- Table `mydb`.`Message`
-- -----------------------------------------------------
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
-- Table `mydb`.`Accounts_Attending`
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
-- Table `Post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Post` (
  `PostID` INT NOT NULL,
  `Accounts_CNUID` INT NOT NULL,
  `PostTime` DATETIME NULL,
  PRIMARY KEY (`PostID`, `Accounts_CNUID`),
  FOREIGN KEY (`Accounts_CNUID`)
  REFERENCES `Accounts` (`UserID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `Community`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Community` (
  `CommID` INT NOT NULL,
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
-- Table `Job Post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Job Post` (
  `idJobPost` INT NOT NULL,
  `Job_location` VARCHAR(45) NULL,
  `Alumni_idAlumni` INT NOT NULL,
  `Accounts_UserID` INT NOT NULL,
  PRIMARY KEY (`idJobPost`, `Alumni_idAlumni`, `Accounts_UserID`),
  FOREIGN KEY (`Accounts_UserID`)
  REFERENCES `Accounts` (`UserID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION);