ALTER TABLE `address_equipment` ADD `ip` VARCHAR( 55 ) NULL DEFAULT NULL AFTER `added_by` ;
ALTER TABLE `equipment` ADD `equipment_slug` VARCHAR( 55 ) NULL DEFAULT NULL AFTER `equipment`;
ALTER TABLE `equipment_inventory` ADD `equipment_id` INT NULL DEFAULT NULL AFTER `equipment_inventory_id` ;

ALTER TABLE `equipment` DROP `seller_id` ,
DROP `serial_number` ,
DROP `date_of_purchase` ,
DROP `assigned` ;



CREATE TABLE IF NOT EXISTS `comment` (
`comment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text,
  `comment_status_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `comment` ADD `added_on` DATETIME NULL DEFAULT NULL AFTER `address_id`;

ALTER TABLE  `user` ADD  `language` VARCHAR( 55 ) NULL DEFAULT NULL AFTER  `email`;

ALTER TABLE `equipment_inventory` CHANGE `serial_number` `serial_number` VARCHAR(255) NULL DEFAULT NULL;


/* ------------------------------------------------------------ */

ALTER TABLE `address` ADD `source_address_id` INT NULL DEFAULT NULL AFTER `longitude`;

ALTER TABLE `address` ADD INDEX( `address`, `zone_id`, `country_id`, `state_id`, `address_type_id`);

/* Query to build export address from zighi */
SELECT address1.*, zone.zone_name, address_type.address_type 
FROM address1 LEFT JOIN zone ON 
	address1.zone_id = zone.zone_id
	LEFT JOIN address_type On
	address1.address_type_id = address_type.address_type_id

INSERT INTO `state` (`state_id`, `state`, `country_id`) VALUES (NULL, 'Abidjan', NULL);

ALTER TABLE `address` ADD `import_jighi_address_id` INT NULL DEFAULT NULL AFTER `source_address_id`;

ALTER TABLE `equipment_inventory` ADD `date_of_added` TIMESTAMP NULL DEFAULT NULL AFTER `status`;


ALTER TABLE  `equipment_inventory` ADD  `date_of_added` DATETIME NOT NULL AFTER  `status` ;