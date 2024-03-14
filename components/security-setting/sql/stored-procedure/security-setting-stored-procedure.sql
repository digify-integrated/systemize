DELIMITER //

/* Security Setting Stored Procedures */

CREATE PROCEDURE getSecuritySetting(IN p_security_setting_id INT)
BEGIN
	SELECT * FROM security_setting
	WHERE security_setting_id = p_security_setting_id;
END //