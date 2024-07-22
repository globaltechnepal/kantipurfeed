
CREATE TABLE `api` (
  `id` int(11) NOT NULL,
  `api_name` varchar(250) NOT NULL,
  `api_value` varchar(255) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL
);


INSERT INTO `api` (`id`, `api_name`, `api_value`, `remarks`) VALUES
(30, 'Orders', 'https://myomsapi.globaltechsolution.com.np/api/Order/BToBSaveOrder ', NULL),
(42, 'Products', 'https://myomsapi.globaltechsolution.com.np/api/MasterList/productlist?DbName=erpdemo101 ', NULL),
(97, 'Cancel', 'https://myomsapi.globaltechsolution.com.np/api/Order/BToBCancelOrder', NULL);


ALTER TABLE `api`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;
