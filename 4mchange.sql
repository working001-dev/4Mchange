/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

CREATE TABLE `tbPart`
(
  `partId` int NOT NULL,
  `partName` varchar(255) NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1,
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`partId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbProcess`
(
  `processId` int NOT NULL,
  `processName` varchar(255) NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1,
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`processId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbReasonType`
(
  `reasonTypeId` int NOT NULL,
  `reasonTypeName` varchar(255) NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1,
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`reasonTypeId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbProduction`
(
  `productionId` int NOT NULL,
  `productionName` varchar(255) NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1,
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`productionId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbDocumentGroup`
(
  `documentGroupId` int NOT NULL,
  `documentGroupName` varchar(255) NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1,
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`documentGroupId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbLine`
(
  `lineId` int NOT NULL,
  `lineName` varchar(255) NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1,
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`lineId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbChangeType`
(
  `changeTypeId` int NOT NULL,
  `changeTypeName` varchar(255) NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1,
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`changeTypeId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbInspectionLocation`
(
  `inspectionLocationId` int NOT NULL,
  `inspectionLocationName` varchar(255) NOT NULL,
  `inspectionControlSpec` decimal(10,3) NOT NULL,
  `specErrorMin` decimal(10,3) NOT NULL,
  `specErrorMax` decimal(10,3) NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1,
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`inspectionLocationId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbChangeDetail`
(
  `changeDetailId` int NOT NULL,
  `changeTypeId` int NOT NULL,
  `changeReasonId` int NOT NULL,
  `description` varchar(1000) NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1,
  `isActive` int NOT NULL DEFAULT 1,
  `updateDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `updateBy` int NOT NULL DEFAULT 1,
  `statusId` int NOT NULL DEFAULT 1,
  `4mNumber` varchar(12) NOT NULL,
  `productionId` int NULL,
  `lineId` int NULL,
  `processId` int NULL,
  `partId` int NULL,
  PRIMARY KEY (`changeDetailId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbChangeInspection`
(
  `changeInspectionId` int NOT NULL,
  `changeDetailId` int NOT NULL,
  `inspectionLocationId` int NOT NULL,
  `inspectionControlValue` decimal(10,3) NOT NULL,
  `inspectionControlResult` int NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL,
  `updateDatetime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `updateBy` int NOT NULL DEFAULT 1,
  `description` varchar(1000) NULL,
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`changeInspectionId`)
  ) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbChangeReason`
(
  `changeReasonId` int NOT NULL,
  `changeReasonName` varchar(1000) NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1,
  `isActive` int NOT NULL DEFAULT 1,
  `reasonTypeId` int NOT NULL,
  PRIMARY KEY (`changeReasonId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbProductionLine`
(
  `productionLineId` int NOT NULL,
  `productionId` int NOT NULL,
  `lineId` int NOT NULL,
  `processId` int NOT NULL,
  `partId` int NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1,
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`productionLineId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbDocument`
(
  `documentId` int NOT NULL,
  `documentGroupId` int NOT NULL,
  `documentName` varchar(255) NOT NULL,
  `documentSeqence` int NOT NULL DEFAULT 1,
  `changeDetailId` int NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1,
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`documentId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbQualityInspection`
(
  `qualityInspectionId` int NOT NULL,
  `changeDetailId` int NOT NULL,
  `inspectionLocationId` int NOT NULL,
  `inspectionControlValue` decimal(10,3) NOT NULL,
  `inspectionControlResult` int NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1,
  `updateDatetime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `updateBy` int NOT NULL DEFAULT 1,
  `description` varchar(1000) NULL,
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`qualityInspectionId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbuser_login`
(
  `userLoginId` int NOT NULL,
  `userLoginName` varchar(255) NOT NULL,
  `userLoginPass` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `roleId` varchar(255) NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1,
  `updateDatetime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `updateBy` int NOT NULL DEFAULT 1, 
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`userLoginId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbrole`
(
  `roleId` int NOT NULL,
  `roleName` varchar(255) NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1,
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`roleId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbrole_menu`
(
  `roleMenuId` int NOT NULL,
  `roleId` int NOT NULL,
  `groupMenuId` int NOT NULL,
  `menuId` int NOT NULL, 
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1, 
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`roleMenuId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbgroup_menu`
(
  `groupMenuId` int NOT NULL, 
  `groupMenuName` varchar(255) NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1, 
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`groupMenuId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbmenu`
(
  `menuId` int NOT NULL, 
  `menuName` varchar(255) NOT NULL,
  `createDateTime` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
  `createBy` int NOT NULL DEFAULT 1, 
  `isActive` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`menuId`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;


#select * from tbuser_login;
#select * from tbrole;
#select * from tbgroup_menu;
#select * from tbmenu;

#select * from tbrole_menu;
#truncate tbrole;

insert into tbuser_login( userLoginName, userLoginPass, firstName, lastName, fullName,  email, roleId)
values( 'admins', '15abc3c39dec3a2c61500a59cc714c31', 'Administator', '', 'Administator', null, 1);

insert into tbrole( roleName ) values ('administator');

insert into tbgroup_menu ( groupMenuName, icon ) 
values 
('home', 'fa fa-desktop'),
('user', 'fa fa-users'),
('permission', 'fa-list-alt'),
('group', 'fa fa-users'),
('setting', 'fa fa-cogs'),
('4m chnage', 'fa fa-pencil-square-o'),
('report', 'fa fa-file-o'); 

insert into tbmenu ( menuName, menuLink ) 
values 
('Dashboard Status', 'dashboard'),
('Add User', 'users/add'),
('Manage User', 'users/manage'),
('Manage Permission', 'users/permission'),
('Permission Group', 'user/permissiongroup'),
('Manage Group', 'users/group'),
('Change Password', 'users/chanhepass'),
('Edis Profile', 'users/edit'),
('Add New Case', 'changes/add'),
('Manage Case', 'changes/manage'),
('Daily', 'changes/report/daily'),
('Weekly', 'changes/report/weekly'),
('Monthly', 'changes/report/monthly'),
('Case status', 'changes/status'); 

