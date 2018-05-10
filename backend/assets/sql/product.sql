
DROP TABLE IF EXISTS  `product`;
CREATE TABLE `product` (
`product_id` int(11) NOT NULL AUTO_INCREMENT  PRIMARY KEY COMMENT '产品ID',
`product_title_en` varchar(255) DEFAULT '' COMMENT '产品英文名称',
`product_title` varchar(255) DEFAULT '' COMMENT '产品中文名',
`product_purchase_value` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '建议采购价',
`ref_url1` varchar(255) DEFAULT NULL COMMENT 'Amazon参考网址',
`ref_url2` varchar(255) DEFAULT NULL COMMENT 'eBay参考网址',
`ref_url3` varchar(255) DEFAULT NULL COMMENT '1688参考网址',
`ref_url4` varchar(255) DEFAULT NULL COMMENT '其他参考网址',
`product_add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '产品添加时间',
`product_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '产品最后更新时间',
`purchaser` varchar(32)  NOT NULL COMMENT '采购'

)ENGINE=InnoDB DEFAULT CHARSET=utf8;


