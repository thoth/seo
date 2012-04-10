<?php 
	define('LINKS_SCOPE_PAGE_TO_PAGE', 'page_to_page');
	define('LINKS_SCOPE_PAGE_TO_SUBDOMAIN', 'page_to_subdomain');
	define('LINKS_SCOPE_PAGE_TO_DOMAIN', 'page_to_domain');
	define('LINKS_SCOPE_DOMAIN_TO_PAGE', 'domain_to_page');
	define('LINKS_SCOPE_DOMAIN_TO_SUBDOMAIN', 'domain_to_subdomain');
	define('LINKS_SCOPE_DOMAIN_TO_DOMAIN', 'domain_to_domain');
	
	define('LINKS_SORT_PAGE_AUTHORITY', 'page_authority');
	define('LINKS_SORT_DOMAIN_AUTHORITY', 'domain_authority');
	define('LINKS_SORT_DOMAINS_LINKING_DOMAIN', 'domains_linking_domain');
	define('LINKS_SORT_DOMAINS_LINKING_PAGE', 'domains_linking_page');
	
	define('LINKS_FILTER_INTERNAL', 'internal');
	define('LINKS_FILTER_EXTERNAL', 'external');
	define('LINKS_FILTER_NOFOLLOW', 'nofollow');
	define('LINKS_FILTER_FOLLOW', 'follow');
	define('LINKS_FILTER_301', '301');
	
	define('LINKS_COL_ALL', '0');
	define('LINKS_COL_TITLE', '1');
	define('LINKS_COL_URL', '4');
	define('LINKS_COL_SUBDOMAIN', '8');
	define('LINKS_COL_ROOT_DOMAIN', '16');
	define('LINKS_COL_EXTERNAL_LINKS', '32');
	define('LINKS_COL_SUBDMN_EXTERNAL_LINKS', '64');
	define('LINKS_COL_ROOTDMN_EXTERNAL_LINKS', '128');
	define('LINKS_COL_JUICE_PASSING_LINKS', '256');
	define('LINKS_COL_SUBDMN_LINKS', '512');
	define('LINKS_COL_ROOTDMN_LINKS', '1024');
	define('LINKS_COL_LINKS', '2048');
	define('LINKS_COL_SUBDMN_SUBDMN_LINKS', '4096');
	define('LINKS_COL_ROOTDMN_ROOTDMN_LINKS', '8192');
	define('LINKS_COL_MOZRANK', '16384');
	define('LINKS_COL_SUBDMN_MOZRANK', '32768');
	define('LINKS_COL_ROOTDMN_MOZRANK', '65536');
	define('LINKS_COL_MOZTRUST', '131072');
	define('LINKS_COL_SUBDMN_MOZTRUST', '262144');
	define('LINKS_COL_ROOTDMN_MOZTRUST', '524288');
	define('LINKS_COL_EXTERNAL_MOZRANK', '1048576');
	define('LINKS_COL_SUBDMN_EXTERNALDMN_JUICE', '2097152');
	define('LINKS_COL_ROOTDMN_EXTERNALDMN_JUICE', '4194304');
	define('LINKS_COL_SUBDMN_DOMAIN_JUICE', '8388608');
	define('LINKS_COL_ROOTDMN_DOMAIN_JUICE', '16777216');
	define('LINKS_COL_CANONICAL_URL', '268435456');
	define('LINKS_COL_HTTP_STATUS_CODE', '536870912');
	define('LINKS_COL_LINKS_TO_SUBDMN', '4294967296');
	define('LINKS_COL_LINKS_TO_ROOTDMN', '8589934592');
	define('LINKS_COL_ROOTDMN_LINKS_SUBDMN', '17179869184');
	define('LINKS_COL_PAGE_AUTHORITY', '34359738368');
	define('LINKS_COL_DOMAIN_AUTHORITY', '68719476736');
?>