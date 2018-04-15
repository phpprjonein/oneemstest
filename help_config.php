<<<<<<< HEAD
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
//include_once ('config/session_check_cellsite_tech.php');

$page_title = 'OneEMS';

?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
   <script src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid" id="cellsitech-config">
	<?php include_once ('menu.php'); ?> 
        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
<!-- table manipulation row -->
    <div class="form-row align-items-center justify-content-between border"></div>
<!-- /table maniupulation row -->

<!-- help guide content row -->
    <div class="row">

<!-- help guide navigation -->
      <div class="col-md-3 col-sm-12">
        <nav id="navbar-help" class="navbar navbar-light bg-light">
          <nav class="nav nav-pills flex-column">
<h6 class="Text-center">CONTENTS</h6>
            <a class="nav-link" href="help.php">GETTING STARTED</a>
            <a class="nav-link" href="help_network_elements.php">NETWORK ELEMENTS</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="help_network_elements.php#item-2-2-1">List Management Options</a>
              <a class="nav-link ml-3 my-1" href="help_network_elements.php#item-2-3">Health Check Details View</a>
            </nav>
            <a class="nav-link" href="help_discovery_ips.php">DISCOVERY IPs</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="help_discovery_ips.php#item-3-1">Subnet Addition</a>
            </nav>
            <a class="nav-link" href="help_discovery_results.php">DISCOVERY RESULTS</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-1">Missed IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-2">New IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-3">OK IP Addresses</a>
			  <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-4">Manual Discovery</a>
            </nav>
            <a class="nav-link" href="help_backup.php">BACKUP</a>
            <a class="nav-link help active" href="#item-6">CONFIGURATION</a>
            <a class="nav-link" href="help_faqs.php">FAQs</a>
          </nav>
        </nav>
      </div>
<!-- /help guide navigation -->

<!-- help guide -->
      <div class="col-md-9 col-sm-12 scrollspy-example" data-spy="scroll" data-target="#navbar-help" data-offset="0">
        <hr class="d-md-none" />
        <h4 id="item-6">CONFIGURATION</h4>
        <p>This Dashboard consists of a file upload interface that allows a user to manage <b>Configuration Scripts</b> for any device within the OneEMS system. On this screen, a user can:</p>
        <ul>
          <li>Enter values into editable fields</li>
          <li>Download your edits as a script</li>
        </ul>
        <p class="border"><b class="text-danger">NOTE:</b> The ASR 920 series Routers for the Great Lakes Region is provided as a default template. This is the first Region available in the OneEMS system. Future enhancements will permit users to select templates for other Vendors, Markets and other filtering criteria.</p>
        <img src="resources/img/screenshot-config1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-config1">
        <p></p>
        <span class="font-italic"><b>FIG. 6.1 - Configuration Dashboard</b></span>
        <p></p>
        <p>To manage device scripts, a user can upload one from their hard drive. Doing so produces a form on the right in which a user can edit values.</p>
        <p class="border"><b class="text-danger">NOTE:</b> The OneEMS application cannot consume files that have anything besides <b>.txt</b> extensions.
        <br><br>
        Additionally, editable fields <b>MUST</b> be encapsulated by a hash ( <b>#</b> ) symbol. This symbol must appear on both the left and right sides of an editable field. Acceptable values within the encapsulated area are the letters "X", "Y", "A", "B" or "C". These characters must be capitalized. The OneEMS application recognizes strings configured in this way as editable.</p>
        <p>Once a user has either manipulated the default values in the form on the right or changed the values of the script they have uploaded, they can then download this edited script for application on devices of their choosing.</p>
        <p>Here is an example of a properly formatted script file:</p>
        <div class="scroller">
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
ip domain name ncmwireless.com
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
        <hr>
        <a href="#top" class="border"><b>Back to top</b></a>
        <hr>
        <div class="row">
          <div class="col-6">
            <a href="help_backup.php" class="border"><b><< PREV: Backups</b></a>
          </div>
          <div class="col-6 text-right">
            <a href="help_faqs.php" class="border"><b>NEXT: FAQs  >></b></a>
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
    <div class="modal fade show" id="screenshot-dashboard1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-dashboard1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-map1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-map1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-healthcheck1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-healthcheck1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-healthcheck2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-healthcheck2_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-healthcheck3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-healthcheck3_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-ip_management_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_choose_Region-1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm text-center">
          <img src="resources/img/screenshot-ip_management_choose_Region-1_LARGE.png" alt="" width="">
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_choose_Region-2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm text-center">
          <img src="resources/img/screenshot-ip_management_choose_Region-2_LARGE.png" alt="" width="">
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_add_subnet-1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-ip_management_add_subnet-1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_add_subnet-2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-ip_management_add_subnet-2_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-discovery-missed" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-discovery-missed_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-discovery-new" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-discovery-new_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-discovery-ok" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-discovery-ok_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-backup1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-backup1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-backup2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-backup2_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-config1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-config1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
  </div>
<!-- /image modals -->

<!-- footer div -->
  <footer class="footer">
    <div class="container">
      <span class="text-muted">Place sticky footer content here.</span>
    </div>
  </footer>
<!-- /footer div -->

<!-- image modals -->
  <div class="big-modal">
    <div class="modal fade show" id="screenshot-dashboard1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-dashboard1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-map1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-map1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-healthcheck1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-healthcheck1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-healthcheck2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-healthcheck2_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-healthcheck3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-healthcheck3_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-ip_management_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_choose_Region-1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm text-center">
          <img src="resources/img/screenshot-ip_management_choose_Region-1_LARGE.png" alt="" width="">
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_choose_Region-2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm text-center">
          <img src="resources/img/screenshot-ip_management_choose_Region-2_LARGE.png" alt="" width="">
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_add_subnet-1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-ip_management_add_subnet-1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_add_subnet-2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-ip_management_add_subnet-2_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-discovery-missed" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-discovery-missed_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-discovery-new" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-discovery-new_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-discovery-ok" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-discovery-ok_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-backup1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-backup1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-backup2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-backup2_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-config1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-config1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
  </div>
<!-- /image modals -->

<!-- footer div -->
      <span class="text-muted"><?php include_once ('footer.php'); ?> </span>
<!-- /footer div -->

<!-- JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS. Must load stack in this order for this page; popovers will not work otherwise -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        
    </body>
</html>
=======
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

?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
   <script src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid">
	<?php include_once ('menu.php'); ?>
        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
<!-- table manipulation row -->
    <div class="form-row align-items-center justify-content-between border"></div>
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
            <a class="nav-link" href="help_discovery_ips.php">DISCOVERY IPs</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="help_discovery_ips.php#item-3-1">Subnet Addition</a>
            </nav>
            <a class="nav-link" href="help_discovery_results.php">DISCOVERY RESULTS</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-1">Missed IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-2">New IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-3">OK IP Addresses</a>
			  <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-4">Manual Discovery</a>
            </nav>
            <a class="nav-link" href="help_backup.php">BACKUP</a>
            <a class="nav-link help active" href="#item-6">CONFIGURATION</a>
            <a class="nav-link" href="help_faqs.php">FAQs</a>
          </nav>
        </nav>
      </div>
<!-- /help guide navigation -->

<!-- help guide -->
      <div class="col-md-9 col-sm-12 scrollspy-example" data-spy="scroll" data-target="#navbar-help" data-offset="0">
        <hr class="d-md-none" />
        <h4 id="item-6">CONFIGURATION</h4>
        <p>This Dashboard consists of a file upload interface that allows a user to manage <b>Configuration Scripts</b> for any device within the OneEMS system. On this screen, a user can:</p>
        <ul>
          <li>Enter values into editable fields</li>
          <li>Download your edits as a script</li>
        </ul>
        <p class="alert alert-danger"><b class="text-danger">NOTE:</b> The ASR 920 series Routers for the Great Lakes Region is provided as a default template. This is the first Region available in the OneEMS system. Future enhancements will permit users to select templates for other Vendors, Markets and other filtering criteria.</p>
        <img src="resources/img/screenshot-config1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-config1">
        <p></p>
        <span class="font-italic"><b>FIG. 6.1 - Configuration Dashboard</b></span>
        <p></p>
        <p>To manage device scripts, a user can upload one from their hard drive. Doing so produces a form on the right in which a user can edit values.</p>
        <p class="alert alert-danger"><b class="text-danger">NOTE:</b> The OneEMS application cannot consume files that have anything besides <b>.txt</b> extensions.
        <br><br>
        Additionally, editable fields <b>MUST</b> be encapsulated by a hash ( <b>#</b> ) symbol. This symbol must appear on both the left and right sides of an editable field. Acceptable values within the encapsulated area are the letters "X", "Y", "A", "B" or "C". These characters must be capitalized. The OneEMS application recognizes strings configured in this way as editable.</p>
        <p>Once a user has either manipulated the default values in the form on the right or changed the values of the script they have uploaded, they can then download this edited script for application on devices of their choosing.</p>
        <p>Here is an example of a properly formatted script file:</p>
        <div class="scroller">
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
ip domain name verizonwireless.com
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
        <hr>
        <a href="#top" class="border"><b>Back to top</b></a>
        <hr>
        <div class="row">
          <div class="col-6">
            <a href="help_backup.php" class="border"><b><< PREV: Backups</b></a>
          </div>
          <div class="col-6 text-right">
            <a href="help_faqs.php" class="border"><b>NEXT: FAQs  >></b></a>
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
          <img src="resources/img/screenshot-config1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
  </div>
<!-- /image modals -->

<!-- footer div -->
      <span class="text-muted"><?php include_once ('footer.php'); ?> </span>
<!-- /footer div -->

<!-- JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS. Must load stack in this order for this page; popovers will not work otherwise -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    </body>
</html>
>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46
