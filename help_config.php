<?php
include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
include_once 'functions.php';

// Static variable values set
if (isset($_GET['clear'])) {
    if (strtolower($_GET['clear']) == 'search') {
        unset($_SESSION['search_term']);
    }
}

user_session_check();
// include_once ('config/session_check_cellsite_tech.php');

$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Configuration Help page Description: User has navigated to the Configuration help page.";
write_log($mesg);
?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once("includes.php");  ?>
   <script
	src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid">
	<?php include_once ('menu.php'); ?>
    <?php
    $values = array(
        'Configuration Help' => '#'
    );
    echo generate_site_breadcrumb($values);
    ?>

<!-- Content Wrapper. Contains page content -->
		<div class="content">
<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
<!-- table manipulation row -->
					<div
						class="form-row align-items-center justify-content-between border"></div>
<!-- /table maniupulation row -->

<!-- help guide content row -->
					<div class="row">

<!-- help guide navigation -->
						<div class="col-md-3 col-sm-12">
							<nav id="navbar-help" class="navbar navbar-light bg-light">
								<nav class="nav nav-pills flex-column">
									<h6 class="text-center">CONTENTS</h6>
                                    <a class="nav-link" href="help.php">GETTING STARTED</a>
                                    <a class="nav-link" href="help_network_elements.php">NETWORK ELEMENTS</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_network_elements.php#item-2-2-1">List Management Options</a>
                                        <a class="nav-link ml-3 my-1" href="help_network_elements.php#item-2-3">Health Check Details View</a>
									</nav>
                                    <a class="nav-link" href="help_backup.php">BACKUP</a>
                                    <a class="nav-link" href="#item-4">CONFIGURATION</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_config.php#item-4-1">Load Template - Modification</a>
										<a class="nav-link ml-3 my-1" href="help_config.php#item-4-2">Generate Script - Modification</a>
										<a class="nav-link ml-3 my-1" href="help_config.php#item-4-2-1">Generate Script - Golden</a>
										<a class="nav-link ml-3 my-1" href="help_config.php#item-4-3">Batch Tracking</a>
									</nav>
									<a class="nav-link" href="help_discovery_ips.php">DISCOVERY IPs</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_discovery_ips.php#item-5-1">Subnet Addition</a>
									</nav>
									<a class="nav-link" href="help_discovery_results.php">DISCOVERY RESULTS</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-6-1">Missed IP Addresses</a>
                                        <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-6-2">New IP Addresses</a>
										<a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-6-3">OK IP Addresses</a>
										<a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-6-4">Manual Discovery</a>
									</nav>
									<a class="nav-link" href="help_maintenance.php">MAINTENANCE</a>
									<nav class="nav nav-pills flex-column">
                                        <a class="nav-link ml-3 my-1" href="help_maintenance.php#item-7-1">Software Delivery</a>
										<a	class="nav-link ml-3 my-1" href="help_maintenance.php#item-7-2">Reboot</a>
                                        <a class="nav-link ml-3 my-1" href="help_maintenance.php#item-7-3">Boot Order Sequence</a>
									</nav>
									<a class="nav-link" href="help_tools.php">TOOLS</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_tools.php#item-8-1">Run All Health Checks</a>
									</nav>
									<a class="nav-link" href="help_audit.php">AUDIT</a>
									<nav class="nav nav-pills flex-column">
                                        <a class="nav-link ml-3 my-1" href="help_audit.php#item-audit-1">Customized Audit</a>
                                        <a class="nav-link ml-3 my-1" href="help_audit.php#item-audit-2">Customized Audit History</a>
									</nav>
									<a class="nav-link" href="help_inventory.php">INVENTORY</a>
									<a class="nav-link" href="help_admin.php">ADMIN</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_admin.php#item-9-1">Load Template - Golden</a>
										<a class="nav-link ml-3 my-1" href="help_admin.php#item-9-2">Maintenance</a>
                                    </nav>
									<a class="nav-link" href="help_faqs.php">FAQs</a>
								</nav>
							</nav>
						</div>
<!-- /help guide navigation -->

<!-- config -->
						<div class="col-md-9 col-sm-12 scrollspy-example" data-spy="scroll" data-target="#navbar-help" data-offset="0">
							<hr class="d-md-none" />
							<h4 id="item-4">CONFIGURATION</h4>
							<p>This Dashboard consists of an interface that allows a user to manage <b>Configuration Scripts</b> for any  device within the OneEMS system.</p>
							<p>On these screens, users can create templates and generate scripts by using a robust interface that allows a  user to:
                                <ul>
                                    <li>Select the device series, version and other attributes associated with one  or more templates</li>
                                    <li>Upload a .txt file containing static and variable details found in a  template</li>
                                    <li>Associate auto population criteria for each variable in a template</li>
                                    <li>Save templates to OneEMS for release deployment</li>
                                    <li>Generate scripts based on previously saved templates</li>
                                    <li>Download modification scripts to a local drive or USB or execute a script on one or more live CSR devices remotely</li>
                                    <li>View the status of execution for multiple devices</li>
                                </ul>
							</p>
							<p class="alert alert-danger"><b class="text-danger">NOTE:</b> This Load Template process is slightly different for general users than it is for  administrative users. Click <a href="#item-4-1-2">here</a> for more information on how to load a template as an admin.</p>
							<h5 id="item-4-1">Load Template - Modification (All Users)</h5>
							<img src="resources/img/screenshot-load_template_mod.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-config1">
							<p></p>
							<span class="font-italic"><b>FIG. 4.1 - Configuration Dashboard	With Sample Values Selected</b></span>
                            <p></p>
                            <p>The name will be automatically generated based on the options you select. This template name will be unique  in OneEMS. Clicking <b>NEXT</b> will bring you to a page where you can associate a configuration file to the new  name just created.</p>
							<p>To create a new template, a user starts with selecting categorization options for the template (shown in <b><i>FIG. 4.1</i></b>), then by uploading a new file from their computer by using the browse button (shown in <b><i>FIG. 4.1.2</i></b>).</p>
							<p>Doing so produces a form on the right in which a user can edit values. Many lines do not contain editable fields, but a user can collapse the list to only show editable fields. To do so, click on the check box next to “<b>Hide Readonly Fields</b>”.</p>
                            <p>To manage device scripts, a user can upload one from their hard drive.</p>
                            <img src="resources/img/screenshot-load_template_mod3.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-config1-1-1">
							<p></p>
							<span class="font-italic"><b>FIG. 4.1.2 - File Upload</b></span>
							<p></p>
							<p class="alert alert-danger"><b class="text-danger">NOTE:</b> The OneEMS application cannot consume files that  end in anything besides <b>.txt</b> extensions. <br> <br> Additionally, editable fields <b>MUST</b> be  encapsulated by a hash ( <b>#</b> )  symbol. This symbol must appear on both the left and right sides of an  editable field. Acceptable values within the encapsulated area are the letters "X", "Y", "A", "B" or "C". These  characters must be capitalized. The OneEMS application recognizes strings configured in this way as editable.</p>
							<p>Once a user has either manipulated the default values in the form on the right or changed the values of the script they have  uploaded, they can then download this edited script for application on devices of their  choosing.</p>
							<p>Here is an example of a properly formatted script file:</p>
							<div class="scroller border">
								<samp>
									<pre>
              service nagle
no service pad
service tcp-keepalives-in
service tcp-keepalives-out
service timestamps debug datetime msec localtime show-timezone
service timestamps log datetime msec localtime show-timezone
service password-encryption
no platform punt-keepalive disable-kernel-core
!
hostname #XXXXXXXXXXXXXXXXXX#
!
boot-start-marker
boot system bootflash:asr920-universalk9_npe.03.17.01.S.156-1.S1-std.bin
boot-end-marker
!
!
vrf definition CELL_MGMT
 description CELL_MGMT VRF
 rd #XXXXX#:3000
 !
 address-family ipv4
  route-target export #XXXXX#:3000
  route-target import #XXXXX#:3000
 exit-address-family
 !
 address-family ipv6
  route-target export #XXXXX#:3001
  route-target import #XXXXX#:3001
 exit-address-family
!
vrf definition LTE
 description LTE VRF
 rd #XXXXX#:4000
 !
 address-family ipv6
  route-target export #XXXXX#:4001
  route-target import #XXXXX#:4001
 exit-address-family
!
vrf definition Mgmt-intf
 !
 address-family ipv4
 exit-address-family
 !
 address-family ipv6
 exit-address-family
!
logging buffered 2000000
logging rate-limit console all 15 except critical
no logging console
no logging monitor
enable secret #XXXXXXXXXX#
!
aaa new-model
aaa authentication login default local-case
aaa authorization config-commands
aaa authorization exec default local if-authenticated
aaa authorization commands 15 default if-authenticated
aaa session-id common
!
ethernet cfm ieee
ethernet cfm global
ethernet cfm traceroute cache
ethernet cfm domain Y.1731 level 1
 service #XXXXX#-1 evc EVC#XXXX#
 service #XXXXX#-2 evc EVC#XXXX#
!
ethernet evc EVC#XXXX#
!
ethernet evc EVC#XXXX#
!
clock timezone EST -5 0
clock summer-time EST recurring
no ip source-route
!
ip vrf 1XRTT
 description 1XRTT VRF
 rd #XXXXX#:2000
 route-target export #XXXXX#:2000
 route-target import #XXXXX#:2000
!
ip vrf RAN
 description EVDO VRF
 rd #XXXXX#:1000
 route-target export #XXXXX#:1000
 route-target import #XXXXX#:1000
!
no ip domain lookup
ip domain name NCMwireless.com
!
ip multicast-routing distributed
ip dhcp excluded-address #X.X.X.X# #X.X.X.X#
ip dhcp excluded-address #X.X.X.X# #X.X.X.X#
ip dhcp excluded-address #X.X.X.X# #X.X.X.X#
ip dhcp excluded-address #X.X.X.X# #X.X.X.X#
!
ip dhcp pool BTS#XXXXXX#
 network #X.X.X.X# 255.255.255.240
 bootfile /screl/active/boot/bts-471.boot
 next-server #X.X.X.X#
 dns-server #X.X.X.X#
 option 26 hex 05dc
 option 43 ascii "10.188.130.136;10.188.130.143;10.188.0.1;scadmneft;motoneft;255.255.255.248"
 default-router #X.X.X.X#
 lease 0 1
ip dhcp pool BTS#XXXXXX#
 network #X.X.X.X# 255.255.255.240
 bootfile /screl/active/boot/bts-471.boot
 next-server #X.X.X.X#
 dns-server #X.X.X.X#
 option 26 hex 05dc
 option 43 ascii "10.188.130.136;10.188.130.143;10.188.0.1;scadmneft;motoneft;255.255.255.248"
 default-router #X.X.X.X#
 lease 0 1
!
ipv6 unicast-routing
ipv6 multicast-routing
ipv6 multicast-routing vrf LTE
ipv6 multicast vrf LTE mpls source Loopback400
ipv6 multicast vrf LTE mpls mldp
!
mpls label protocol ldp
mpls ldp graceful-restart
mpls ldp tcp pak-priority
no mpls ldp advertise-labels
mpls ldp advertise-labels for LOOPBACKS
mpls mldp logging notifications
!
!
archive
 log config
  logging enable
  logging size 1000
  hidekeys
 path bootflash:ARCHIVE/
!
username PAMadmin privilege 15 secret N3Wbui!d
username PAMadmingrp privilege 15 secret N3Wbui!d
username PAMronlygrp privilege 7 secret N3Wbui!d
username solkcpnebh privilege 15 secret 5 $1$MDA5$NY0xW7ae8RRmY57JjhqGL1
username njbbcpnebh privilege 15 secret 5 $1$YEL0$V8AvjQSmtM3WxxRUfeC/p0
username sev1snmpuser password CwvjqqTT5tQj
username #XXXXXXX# privilege 15 secret #XXXXXXXXXX#
!
ip pim rp-address #X.X.X.X# MCAST_GRP_AN#XXXX# override
ip pim register-source Loopback0
!
class-map match-any CTRL-IN
 match mpls experimental topmost 6  7
 match dscp cs6  cs7
 match precedence 6  7
class-map match-any BEARER-IN
 match dscp cs5  ef
 match precedence 5
 match mpls experimental topmost 5
class-map match-any VIDEO-OUT
 match qos-group 3
class-map match-any PRIORITY-IN
 match mpls experimental topmost 2
 match dscp cs2
 match precedence 2
class-map match-any SIG-OUT
 match qos-group 4
class-map match-any BEARER-OUT
 match qos-group 5
class-map match-any CTRL-OUT
 match qos-group 6
class-map match-any PRIORITY-OUT
 match qos-group 2
class-map match-any SIG-IN
 match mpls experimental topmost 4
 match dscp af12  af13  cs4
 match precedence 4
class-map match-any VIDEO-IN
 match mpls experimental topmost 3
 match dscp cs3
 match precedence 3
!
policy-map METER-IN
 class CTRL-IN
  set qos-group 6
 class BEARER-IN
  set qos-group 5
 class PRIORITY-IN
  set qos-group 2
 class SIG-IN
  set qos-group 4
 class VIDEO-IN
  set qos-group 3
 class class-default
  set qos-group 0
policy-map SHAPE-OUT
class BEARER-OUT
  police cir percent 80
  priority level 2
  set cos 5
 class CTRL-OUT
  set cos 7
  police cir percent 2
  priority level 1
 class SIG-OUT
  bandwidth remaining percent 47
  set cos 4
 class VIDEO-OUT
  bandwidth remaining percent 25
  set cos 3
 class PRIORITY-OUT
  bandwidth remaining percent 15
  set cos 2
 class class-default
  bandwidth remaining percent 13
  set cos 0
  queue-limit 450000 bytes
policy-map #XXX#MB-4#X#MB
 class class-default
  shape average #XXXXXXXXX#
   service-policy SHAPE-OUT
policy-map METER-OUT
 class CTRL-OUT
 class BEARER-OUT
 class PRIORITY-OUT
 class SIG-OUT
 class VIDEO-OUT
 class class-default
!
interface Loopback0
 description Global Loopback
 ip address #X.X.X.X# 255.255.255.255
 ip pim sparse-mode
!
interface Loopback300
 description CELL_MGMT VRF Loopback
 vrf forwarding CELL_MGMT
 ip address #X.X.X.X# 255.255.255.255
 ipv6 address #X:X:X:X:X:X:X:X#/128
 ipv6 traffic-filter Drop_ANI_IPv6 in
!
interface Loopback400
 description LTE VRF Loopback
 vrf forwarding LTE
 no ip address
 ipv6 address #X:X:X:X:X:X:X:X#/128
 ipv6 traffic-filter Drop_ANI_IPv6 in
!
interface range GigabitEthernet 0/0/0-23
service-policy input METER-IN
!
interface GigabitEthernet0/0/0
 description Physical interface to Backhaul
 mtu #XXXX#
 bandwidth #XXXX#
 no ip address
 load-interval 30
 carrier-delay msec 150
 negotiation auto
 cdp enable
 service-policy input METER-IN
 service-policy output #XXX#MB-4#X#MB
 service instance #XXXX# ethernet
  description #XXXXXXXX#
  encapsulation dot1q #XXXX#
  rewrite ingress tag pop 1 symmetric
  bridge-domain #XXXX#
  ethernet loopback permit external
 service instance #XXXX# ethernet
  description #XXXXXXXX#
  encapsulation dot1q #XXXX#
  rewrite ingress tag pop 1 symmetric
  bridge-domain #XXXX#
  ethernet loopback permit external
!
interface GigabitEthernet0/0/#X#
 description eNB - MacroNodeID -#XX#
 mtu 1956
 no ip address
 load-interval 30
 media-type sfp
 negotiation auto
 service-policy input METER-IN
 service-policy output METER-OUT
 !
 service instance 300 ethernet
  description CELL_MGMT eNB OAM
  encapsulation dot1q 101
  rewrite ingress tag pop 1 symmetric
  bridge-domain 300
 !
 service instance 400 ethernet
  description LTE VLAN
  encapsulation dot1q 100
  rewrite ingress tag pop 1 symmetric
  bridge-domain 400
!
interface GigabitEthernet0/0/#X#
 description Frame 1 GLI-1 #XXX#
 no ip address
 load-interval 30
 media-type rj45
 speed 1000
 no shut
 negotiation auto
 service instance 48#X# ethernet
  encapsulation untagged
  bridge-domain 48#X#
!
interface GigabitEthernet0/0/#X#
 description UBS #XXX#
 no ip address
 load-interval 30
 media-type RJ45
 negotiation auto
 service-policy input METER-IN
 service instance 4#XX# Ethernet
  encapsulation dot1q 4#XX#
  rewrite ingress tag pop 1 symmetric
  bridge-domain 4#XX#
 service instance 4#XX# ethernet
  encapsulation dot1q 4#XX#
  rewrite ingress tag pop 1 symmetric
  bridge-domain 4#XX#
!
interface Gi0/0/#X#
 description Link to MCCDO - #BTS DO#
 ip vrf forwarding RAN
 ip address #X.X.X.X# 255.255.255.252
 load-interval 30
 negotiation auto
!
interface GigabitEthernet0/0/11
 no ip address
 mtu 1970
 media-type sfp
 negotiation auto
 service instance #XXXX# Ethernet EVC#XXXX#
  encapsulation dot1q #XXXX#
  xconnect #X.X.X.X# #XXXX# encapsulation mpls
  cfm mep domain Y.1731 mpid 1
 service instance #XXXX# Ethernet EVC#XXXX#
  encapsulation dot1q #XXXX#
  xconnect #X.X.X.X# #XXXX# encapsulation mpls
  cfm mep domain Y.1731 mpid 1
!
interface BDI300
 description OAM VLAN
 vrf forwarding CELL_MGMT
 ip address #X.X.X.X# 255.255.255.248
 ip mtu 1956
 load-interval 30
 ipv6 address #X:X:X:X:X::#/64
 ipv6 mtu 1956
 ipv6 traffic-filter Drop_ANI_IPv6 in
 no shut
!
interface BDI400
 description Bearer VLAN
 vrf forwarding LTE
 no ip address
 ip mtu 1956
 load-interval 30
 ipv6 address #X:X:X:X::X#/64
 ipv6 mtu 1956
 ipv6 traffic-filter Drop_ANI_IPv6 in
 no shut
!
interface BDI#XXXX#
 description Transport VLAN to #XXXXXXXXXX#
 ip address #X.X.X.X# 255.255.255.254
 mpls ip
 ip mtu #XXXX#
 ip pim query-interval 2
 ip pim sparse-mode
 mpls mtu #XXXX#
 load-interval 30
 bfd interval 100 min_rx 100 multiplier 3
 no shut
!
interface BDI#XXXX#
 description Transport VLAN to #XXXXXXXXXX#
 ip address #X.X.X.X# 255.255.255.254
 mpls ip
 ip mtu #XXXX#
 ip pim query-interval 2
 ip pim sparse-mode
 mpls mtu #XXXX#
 load-interval 30
 bfd interval 100 min_rx 100 multiplier 3
 no shut
!
interface BDI4#XX#
 description UBS #XXXX# CDMA vlan #XXX#
 ip address #X.X.X.X# 255.255.255.240
 ip pim bsr-border
 ip pim sparse-mode
 ip mobile arp
 ip igmp query-max-response-time 5
 ip igmp query-interval 7
 load-interval 30
 no shutdown
!
interface BDI4#XX#
 description UBS #XXXX# EVDO vlan #XXX#
 ip vrf forwarding RAN
 ip address #X.X.X.X# 255.255.255.240
!
interface BDI48#X#
 description GLI BD Interfaces
 ip address #X.X.X.X# 255.255.255.240
 ip pim bsr-border
 ip pim sparse-mode
 ip mobile arp
 ip igmp query-max-response-time 5
 ip igmp query-interval 7
 load-interval 30
 no shutdown
 ntp broadcast
!
router bgp #XXXXX#
 bgp router-id #X.X.X.X#
 bgp log-neighbor-changes
 bgp graceful-restart restart-time 120
 bgp graceful-restart stalepath-time 360
 bgp graceful-restart
 no bgp default ipv4-unicast
 neighbor CSR_PEER_GRP peer-group
 neighbor CSR_PEER_GRP remote-as #XXXXX#
 neighbor CSR_PEER_GRP password #XXXXXXXXXX#
 neighbor CSR_PEER_GRP update-source Loopback0
 neighbor CSR_PEER_GRP version 4
 neighbor #X.X.X.X# remote-as #XXXXX#
 neighbor #X.X.X.X# description MP-IBGP Peering to ASR9010-1
 neighbor #X.X.X.X# password #XXXXXXXXXXX#
 neighbor #X.X.X.X# update-source Loopback0
 neighbor #X.X.X.X# version 4
 neighbor #X.X.X.X# remote-as #XXXXX#
 neighbor #X.X.X.X# description MP-IBGP Peering to ASR9010-2
 neighbor #X.X.X.X# password #XXXXXXXXXXX#
 neighbor #X.X.X.X# update-source Loopback0
 neighbor #X.X.X.X# version 4
!
 address-family vpnv4
  neighbor CSR_PEER_GRP send-community extended
  neighbor CSR_PEER_GRP route-reflector-client
  neighbor #X.X.X.X# activate
  neighbor #X.X.X.X# send-community extended
  neighbor #X.X.X.X# next-hop-self
  neighbor #X.X.X.X# route-map NO_TRANSIT in
  neighbor #X.X.X.X# activate
  neighbor #X.X.X.X# send-community extended
  neighbor #X.X.X.X# next-hop-self
  neighbor #X.X.X.X# route-map NO_TRANSIT in
 exit-address-family
!
 address-family vpnv6
  neighbor CSR_PEER_GRP send-community extended
  neighbor CSR_PEER_GRP route-reflector-client
  neighbor #X.X.X.X# activate
  neighbor #X.X.X.X# send-community extended
  neighbor #X.X.X.X# next-hop-self
  neighbor #X.X.X.X# route-map NO_TRANSIT in
  neighbor #X.X.X.X# activate
  neighbor #X.X.X.X# send-community extended
  neighbor #X.X.X.X# next-hop-self
  neighbor #X.X.X.X# route-map NO_TRANSIT in
 exit-address-family
!
address-family ipv4 vrf CELL_MGMT
  import path selection all
  import path limit 2
  redistribute connected
  redistribute static
  maximum-paths ibgp 2
 exit-address-family
!
 address-family ipv6 vrf CELL_MGMT
  redistribute connected
  redistribute static
  maximum-paths ibgp 2
  import path selection all
  import path limit 2
 exit-address-family
!
 address-family ipv6 vrf LTE
  redistribute connected
  redistribute static
  maximum-paths ibgp 2
 exit-address-family
!
 address-family ipv4 vrf RAN
  import path selection all
  import path limit 2
  redistribute connected
  redistribute static
  maximum-paths ibgp 2
 exit-address-family
!
address-family ipv4 vrf 1XRTT
  import path selection all
  import path limit 2
  redistribute connected
  redistribute static
  maximum-paths ibgp 2
 exit-address-family
!
ip forward-protocol nd
!
ip bgp-community new-format
ip ftp source-interface Loopback300
no ip http server
no ip http secure-server
ip tftp source-interface Loopback300
ip ssh time-out 60
ip ssh authentication-retries 2
ip ssh source-interface Loopback300
ip ssh version 2
ip scp server enable
ip route static bfd BDI#XXXX# #X.X.X.X#
ip route static bfd BDI#XXXX# #X.X.X.X#
ip route #X.X.X.X# 255.255.255.255 BDI#XXXX# #X.X.X.X#
ip route #X.X.X.X# 255.255.255.255 BDI#XXXX# #X.X.X.X#
ip route 0.0.0.0 0.0.0.0 BDI#XXXX# #X.X.X.X#
ip route 0.0.0.0 0.0.0.0 BDI#XXXX# #X.X.X.X#
ip route #X.X.X.X# 255.255.255.248 #X.X.X.X#
ip route #X.X.X.X# 255.255.255.248 #X.X.X.X#
ip route vrf RAN #X.X.X.X# 255.255.255.248 Gig0/0/#X# #X.X.X.X#
!
ip access-list standard LOOPBACKS
 permit #X.X.X.X# 0.0.0.255
!
ip access-list standard SNMP_ACL
remark Version_Q12017
permit 10.132.8.0 0.0.3.255
permit 10.133.176.0 0.0.2.255
permit 10.134.168.0 0.0.3.255
permit 10.134.240.0 0.0.3.255
permit 10.139.84.0 0.0.1.255
permit 10.186.4.0 0.0.0.15
permit 10.186.203.0 0.0.0.15
permit 10.187.4.0 0.0.3.255
permit 10.194.102.0 0.0.1.255
permit 10.194.236.0 0.0.3.255
permit 10.194.92.0 0.0.3.255
deny   any
!
ip prefix-list DEFAULT_ROUTE seq 5 permit 0.0.0.0/0 le 27
ip prefix-list IPV4-EBH-MLS-LOOPBACKS seq 5 permit #X.X.X.X#/32
ip prefix-list IPV4-EBH-MLS-LOOPBACKS seq 10 permit #X.X.X.X#/32
ip access-list standard MCAST_GRP_AN#XXXX#
 permit 239.193.35.0 0.0.0.255
ip access-list standard MCAST_GRP_AN#XXXX#
 permit 239.193.36.0 0.0.0.255
ip access-list standard SSM
 permit 239.193.0.0 0.0.0.255
!
ip radius source-interface Loopback300
logging source-interface Loopback300 vrf CELL_MGMT
!
logging host ipv6 2001:4888:a01:2130:a1:fef:0:115 vrf CELL_MGMT
!
no ipv6 pim vrf LTE rp embedded
no ipv6 pim rp embedded
!
route-map DENY_DEFAULT deny 10
 match ip address prefix-list DEFAULT_ROUTE
!
route-map DENY_DEFAULT permit 20
!
route-map NO_TRANSIT permit 10
 set community no-advertise
!
snmp-server group sev1group v3 auth
username sev1snmpuser password CwvjqqTT5tQj
snmp-server user sev1snmpuser sev1group v3 auth md5 CwvjqqTT5tQj access ipv6 SEV1_ACLv6
snmp-server community 2Y2LHTZP31 RO SNMP_ACL
snmp-server community cellbackhaul RW SNMP_ACL
snmp-server trap link ietf
snmp-server trap-source Loopback300
snmp-server source-interface informs Loopback300
snmp-server enable traps
!
!
snmp-server host 2001:4888:a02:2105:a0:fef:0:5 vrf CELL_MGMT version 2c 2Y2LHTZP31
snmp-server host 2001:4888:a03:210d:c0:fef:0:16 vrf CELL_MGMT version 2c 2Y2LHTZP31
snmp-server host 2001:4888:a01:2106:a1:fef:0:203 vrf CELL_MGMT version 2c 2Y2LHTZP31
snmp-server host 2001:4888:a03:210a:c0:fef:0:203 vrf CELL_MGMT version 2c 2Y2LHTZP31
snmp ifmib ifindex persist
snmp mib persist cbqos
mpls ldp router-id Loopback0 force
!
ipv6 access-list Drop_ANI_IPv6
deny udp any host #X.X.X.X# eq 4936 log
deny udp any host #X.X.X.X# eq 8888 log
permit any any
!
ipv6 access-list SEV1_ACLv6
remark Q22017
permit ipv6 2001:4888:A02:1D10::/60 any
permit ipv6 2001:4888:A06:1D50::/60 any
permit ipv6 2001:4888:A03:1D10::/60 any
permit ipv6 2001:4888:2:1D10::/60 any
permit ipv6 2001:4888:6:1D50::/60 any
permit ipv6 2001:4888:3:1D10::/60 any
deny ipv6 any any
!
ipv6 access-list SNMP_ACLv6
remark Version_Q12017
permit ipv6 2001:4888:A01:2100::/56 any
permit ipv6 2001:4888:A02:2100::/56 any
permit ipv6 2001:4888:A03:2100::/56 any
permit ipv6 2001:4888:A04:2100::/56 any
permit ipv6 2001:4888:A05:2100::/56 any
permit ipv6 2001:4888:A06:2100::/56 any
permit ipv6 2001:4888:A07:2100::/56 any
permit ipv6 2001:4888:A08:2100::/56 any
permit ipv6 2001:4888:A0E:2100::/56 any
permit ipv6 2001:4888:A0F:2100::/56 any
 deny ipv6 any any
!
banner motd ^
***************************************************************************
                            NOTICE TO USERS
This is a private computer system and is for authorized use only. Users
(authorized or unauthorized) have no explicit or implicit expectation of
privacy.
Any or all uses of this system and all files on this system may be
intercepted, monitored, recorded, copied, audited, inspected, and disclosed
to authorized site and law enforcement personnel, as well as authorized
officials of other agencies, both domestic and foreign. By using this
system, the user consents to such interception, monitoring, recording,
copying, auditing, inspection, and disclosure at the discretion of the
authorized site or personnel.
Unauthorized or improper use of this system may result in administrative
disciplinary action and civil and criminal penalties. By continuing to
use this system you indicate your awareness of and consent to these terms
and conditions of use. LOG OFF IMMEDIATELY if you do not agree to the
conditions stated in this warning.
$(hostname) vty $(line)
*****************************************************************************
^
!
line con 0
 exec-timeout 90 0
 no password
 login authentication console-auth
 history size 256
 stopbits 1
 privilege level 15
login
!
line vty 0 15
 exec-timeout 30 0
 no password
 history size 256
 transport input ssh
 transport output ssh
!
exception crashinfo buffersize 128
ntp source Loopback300
ntp server vrf CELL_MGMT 2001:4888:#XXXX:XXXX:XXXX#:22:: prefer
ntp server vrf CELL_MGMT #X.X.X.X#
!
event manager applet LOOP_GIG authorization bypass
 event tag EVEN_BDI_UP syslog pattern "%LINEPROTO-5-UPDOWN: Line protocol on Interface BDI#XXXX#, changed state to up.*"
 event tag ODD_BDI_UP syslog pattern "%LINEPROTO-5-UPDOWN: Line protocol on Interface BDI#XXXX#, changed state to up.*" maxrun 360
 trigger
  correlate event ODD_BDI_UP or event EVEN_BDI_UP
 action 100 cli command "enable"
 action 105 syslog priority informational msg "Applet LOOP_GIG has been triggered"
 action 110 wait 180
 action 115 cli command "ethernet loopback start local interface GigabitEthernet0/0/0 service instance #XXXX# external dot1q #XXXX# destination mac-address 2222.2222.2222 timeout  none" pattern "yes"
 action 120 cli command "yes"
 action 125 cli command "ethernet loopback start local interface GigabitEthernet0/0/0 service instance #XXXX# external dot1q #XXXX# destination mac-address 2222.2222.2222 timeout  none" pattern "yes"
 action 130 cli command "yes"
 action 135 syslog priority informational msg "Applet LOOP_GIG completed"

            </pre>
								</samp>
							</div>
							<p>&nbsp;</p>
							<img src="resources/img/screenshot-config2.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-config2">
							<p></p>
							<span class="font-italic"><b>FIG. 4.2 - Editable Configuration Template</b></span>
							<p></p>
							<b>Auto-populating Configuration Files</b>
							<p>There are several categories for which you can auto-populate a field in a configuration file. For example:
								<ul>
									<li>Global variables: A predefined set of values that are common to all devices
										<ul>
											<li>Device name</li>
											<li>Enable_Secret</li>
											<li>IOS</li>
										</ul>
									</li>
									<li>Market variables: A predefined set of values that are associated to a given market
										<ul>
											<li>BGP Password</li>
											<li>Enable_Secret</li>
											<li>Logging Server</li>
											<li>Password</li>
											<li>RP_Address</li>
											<li>Snmp server1</li>
											<li>Snmp server2</li>
											<li>Time zone</li>
											<li>User name</li>
										</ul>
									</li>
									<li>User variables: Values that a user enters at the time of generating a script
										<ul>
											<li>Bandwidth (Mbps)</li>
											<li>Bandwidth Type</li>
											<li>BDI 300 IPv6 Address</li>
											<li>BDI 400 LTE IPv6 Address</li>
											<li>Bearer Vlan IPv6</li>
											<li>BGP Password-ASR9010-Even</li>
											<li>BGP Password-ASR9010-Odd</li>
											<li>BV3000 Interface-ASR9010-Even</li>
											<li>BV3000 Interface-ASR9010-Odd</li>
											<li>CSR – Bandwidth Type(6/8)</li>
											<li>CSR – Bandwidth(Mbps)</li>
											<li>Enable Secret</li>
											<li>eNodeB_ID</li>
											<li>Even Vlan IP</li>
											<li>Loopback0 IPv4 Address</li>
											<li>Loopback300 IPv4 Address</li>
											<li>Loopback300 IPv6 Address</li>
											<li>Loopback400 IPv6 Address</li>
											<li>MTU</li>
											<li>Odd Vlan IP</li>
											<li>P2P (IPv4)-ASR9010-Even</li>
											<li>P2P (IPv4)-ASR9010-Odd</li>
											<li>Telco Interface-ASR9010-Even</li>
											<li>Telco Interface-ASR9010-Odd</li>
											<li>Time Zone</li>
											<li>Vlan(Even)</li>
											<li>Vlan(Odd)</li>
										</ul>
									</li>
									<li>Switch variables: Predefined values that are associated with a switch name
										<ul>
											<li>AS</li>
											<li>Asr9k-1 Hostname</li>
											<li>Asr9k-1 Loopback0 IP</li>
											<li>Asr9k-1 Loopback10 IP</li>
											<li>Asr9k-2 Hostname</li>
											<li>Asr9k-2 Loopback0 IP</li>
											<li>Asr9k-2 Loopback10 IP</li>
											<li>devicename_prefix</li>
											<li>Loopback10 (EDN11E IPv6)</li>
											<li>Loopback10 (EDN11E IPv4)</li>
										</ul>
									</li>
								</ul>
							</p>
							<p>Select the appropriate variable associated with each field in the configuration file. This is a one-time exercise that will create a template that will be available to all users. This will help standardize the process, save time and reduce chance of errors when generating scripts to run on a device.</p>
							<img src="resources/img/screenshot-config3.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-config3">
							<p></p>
							<span class="font-italic"><b>FIG. 4.2.2 - Editable Configuration Template</b></span>
							<p></p>
							<hr>
							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
							<h5 id="item-4-2">Generate Script - Modification</h5>
							<p>In this view, a user can select an existing template with which to create a script for use on a particular  device.</p>
							<img src="resources/img/screenshot-generate-script.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-generate1">
							<p></p>
							<span class="font-italic"><b>FIG. 4.3 - Script Template Selection</b></span>
							<p></p>
							<p>You can select parameters from the dropdown menu on the right side of the screen, which will reveal  associated templates to choose from. You can further drill down into the results by typing in the <b>Alias Name</b> input field above the table. You can also choose to delete a specific template by clicking on the <b>Delete</b> button next to the template you wish to remove.</p>
							<p class="alert alert-danger"><b class="text-danger">NOTE:</b> Deleting a template is <b>permanent</b> and cannot be undone. Please be sure you wish to actually remove the selected template from the table.</p>
							<b>Edited Template Selection / Download</b>
							<p>Once you select a template from the list, that template will appear with editable fields highlighted in <span  class="text-danger"><b>red</b></span>. You can then edit and download this template for deployment elsewhere or  you can schedule a batch job by clicking on the “Execute” button.</p>
							<p>Once a user executes a configuration template for script execution, that template gets added to a batch  process. More information about this batch process can be found <a  href="help_maintenance.php#item-7-3">HERE</a>.
							</p>
							<img src="resources/img/screenshot-generate-script2.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-generate2">
							<p></p>
							<span class="font-italic"><b>FIG. 4.4 - Generated Template Edit Screen</b></span>
							<p></p>
							<p><b>Selecting One Or More Devices To Run Scripts</b>
							<br />
							Once you select “Execute”, you will be taken to the Batch Page where you can select devices to run a script. The list of devices have been filtered to show devices matching the device series and version only. Select the device by clicking on checkbox on left, set the priority and click submit to create a batch. You will then be prompted to confirm the batch run.</p>
							<img src="resources/img/screenshot-config_confirm-batch.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-confirm-batch">
							<p></p>
							<span class="font-italic"><b>FIG. 4.5 - Running A Script On One Or More Devices</b></span>
							<p></p>
							<p class="alert alert-danger"><b class="text-danger">NOTE:</b> Please retain the Batch ID for your records.</p>
							<p>Once the Batch is successfully scheduled you will get a Batch ID. Please make a note of it so you can view  the status later.</p>
							<img src="resources/img/screenshot-config_confirm-batch2.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-confirm-batch2">
							<p></p>
							<span class="font-italic"><b>FIG. 4.5.6 - Batch ID Created For Your Run</b></span>
							<p></p>
							<p><b>Tracking Your Batch Run</b>
							<br>
							After submitting your batch job you will be taken to the Batch Tracking page or you can return  to this page any  time by navigating the top menu bar (Configuration -> Batch Tracking). The Status field shows you the state  your batch is in; Scheduled, In-progress Completed or Cancelled. You can cancel only batches that are in  “Scheduled” state.</p>
							<img src="resources/img/screenshot-config_batch-status.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-batch-status">
							<p></p>
							<span class="font-italic"><b>FIG. 4.5.7 - View Status Of A Batch Job</b></span>
							<p></p>
							<hr>
							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
							<h5 id="item-4-2-1">Generate Script - Golden</h5>
							<p>Generate Script (Golden) has same flow as Generate Script (Modification) with the following exceptions:
								<ul>
									<li>All fields must be filled out before you can proceed to download a script</li>
									<li>Three scripts are generated (to support site integration; ie., CSR, 9K01 and 9K-02 devices</li>
								</ul>
							</p>
							<img src="resources/img/screenshot-generate-script_gold.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-generate1-2">
							<p></p>
							<span class="font-italic"><b>FIG. 4.5.8 - Script Template Selection (Golden)</b></span>
							<p></p>
							<p>This flow generates <b>three</b> different scripts, one for original CSR routers, one for associated 9k-01 devices and one for 9k-02 devices. Each CSR is associated with a pair of 9ks.</p>
							<p>Click on the links below to view sample scripts for each aforementioned type:
								<ul>
									<li><a href="resources/scripts/golden_script_originalCSR.txt" target="_blank"><b>Original CSR Script</b></a></li>
									<li><a href="resources/scripts/golden_script_CSR9k-01.txt"  target="_blank"><b>9k-01 Script</b></a></li>
									<li><a href="resources/scripts/golden_script_CSR9k-02.txt"  target="_blank"><b>9k-02 Script</b></a></li>
								</ul>
							</p>
							<hr>
							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
							<h5 id="item-4-3">Batch Tracking</h5>
							<p>This batch tracking screen allows users to view the execution status for three areas: <b>Script Execution</b>, <b>Software Delivery</b>, <b>Boot Order</b>, <b>Reboot Status</b>, <b>Audit</b>, and <b>Customized Audit</b>.</p>
							<p>Scripts can be monitored for execution status on a device or sets of devices (<b>Script Execution</b>),  whether or not a template has been applied to a device (<b>Software Delivery</b>) as well as overall job priority application of templated scripts to devices (<b>Boot Order</b>).</p>
							<img src="resources/img/screenshot-batch-tracking1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-batch1">
							<p></p>
							<span class="font-italic"><b>FIG. 4.6 - Batch Tracking View</b></span>
							<p></p>
							<hr>
							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
							<div class="row">
								<div class="col-6">
									<a href="help_backup.php" class="border"><b><< PREV: Backup</b></a>
								</div>
								<div class="col-6 text-right">
									<a href="help_discovery_ips.php" class="border"><b>NEXT: Discovery IPs >></b></a>
								</div>
							</div>
							<hr>
						</div>
					</div>
<!-- /help guide content row -->

				</div>
			</section>
<!-- /.content -->

		</div>
	</div>
<!-- container-fluid -->

<!-- image modals -->
	<div class="big-modal">
		<div class="modal fade show" id="screenshot-config1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-load_template_mod.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-config1-1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-load_template_mod2.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-config1-1-1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-load_template_mod3.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-config2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-config2.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-generate1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-generate-script.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-generate1-2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-generate-script_gold.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-confirm-batch" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-config_confirm-batch.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-confirm-batch2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-config_confirm-batch2.png" alt=""
						width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-batch-status" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-config_batch-status.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-config3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-config3.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-batch1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-batch-tracking1.png" alt="" width="100%">
				</div>
			</div>
		</div>
	</div>
<!-- /image modals -->

<!-- footer div -->
      <?php include_once ('footer.php'); ?>
<!-- /footer div -->

</body>
</html>
