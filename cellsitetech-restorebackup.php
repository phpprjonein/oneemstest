<?php

include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';

//Static variable values set
if (isset($_GET['clear']) ) {
  if (strtolower($_GET['clear']) == 'search') {
    unset($_SESSION['search_term']);
  }
}

user_session_check();
 check_user_authentication('1'); //cellsite tech type user 

    $page_title = 'OneEMS';
 
?>
<!DOCTYPE html>
<html>
    <head>
   <?php include("includes.php");  ?>
   <script src="resources/js/cellsitetech_user_devices.js?t=".<?php echo date('his'); ?>></script>
 </head>
     <body>
        <!-- The Modal -->
		<div class="modal fade" id="myModal">
		  <div class="modal-dialog" >
			<div class="modal-content" id="cellsitech-backuprestore">

			  <!-- Modal Header -->
			  <div class="modal-header">
				<h4 class="modal-title">Back up File name to be restored - $Filename</h4>	
			  </div>

			  <!-- Modal body -->
			  <div class="modal-body">
				RP/0/RSP0/CPU0:AKROOH2092A-P-CI-9010-02#ter len 0
				Mon Jan  8 15:47:46.836 EST
				RP/0/RSP0/CPU0:AKROOH2092A-P-CI-9010-02#
				RP/0/RSP0/CPU0:AKROOH2092A-P-CI-9010-02#
				RP/0/RSP0/CPU0:AKROOH2092A-P-CI-9010-02#
				RP/0/RSP0/CPU0:AKROOH2092A-P-CI-9010-02#
				RP/0/RSP0/CPU0:AKROOH2092A-P-CI-9010-02#
				RP/0/RSP0/CPU0:AKROOH2092A-P-CI-9010-02#
				RP/0/RSP0/CPU0:AKROOH2092A-P-CI-9010-02#sh run
				Mon Jan  8 15:47:50.968 EST
				Building configuration...
				!! IOS XR Configuration 5.3.4
				!! Last configuration change at Sun Jan  7 12:19:11 2018 by jdsuqt600
				!
				hostname AKROOH2092A-P-CI-9010-02
				clock timezone EST -5
				clock summer-time EST recurring 2 sunday march 02:00 first sunday november 02:00 60
				banner motd #
				THIS IS A PRIVATE NETWORK AND COMPUTING SYSTEM FOR EXCLUSIVE USE BY AUTHORIZED
				PERSONNEL ONLY.

				You are requesting access to a private network and computing system for
				exclusive use by authorized persons only.  If you have not been expressly
				authorized to access this system by NCM , please log off
				immediately, otherwise your actions may be subject to civil and/or criminal
				penalties including but not limited to excessive fines and imprisonment.

				NOTICE TO ALL AUTHORIZED USERS:
				This is a private and proprietary system owned, operated and monitored by
				NCM .  Use of this system and any data in transit to/from or stored
				on this system can be accessed, intercepted, monitored, recorded, copied,
				audited and inspected by NCM  and disclosed to third parties and/or
				law enforcement.  Your use of this system constitutes consent to such
				monitoring, disclosure and associated activities.  Any use that exceeds
				authorization or is improper, unlawful, unintended or not permitted (such as
				attempts to upload or change information; to defeat or circumvent security
				features; or to utilize this system other than for its intended purpose) is
				prohibited and may result in immediate revocation of access privileges by
				NCM  and civil and/or criminal prosecution.

				By continuing to use this system you agree to comply with all applicable
				policies and procedures and consent to the terms and conditions contained
				herein.  If you do not agree, please log off immediately.
				#
				exception choice 1 compress on filepath harddisk:
				logging trap informational
				logging console disable
				logging monitor disable
				logging buffered debugging
				logging 10.140.162.99 vrf default severity info port default
				logging 10.219.34.121 vrf default severity info port default
				logging 10.136.235.217 vrf default severity info port default
				logging 2001:4888:a01:2130:a1:fef:0:115 vrf default severity info port default
				logging source-interface Loopback10
				service timestamps log datetime localtime msec show-timezone
				service timestamps debug datetime localtime msec show-timezone
				ipv4 netmask-format bit-count
				event manager directory user policy harddisk:
				event manager policy snapshot.tcl username EBHNCMBB persist-time 3600
				telnet vrf default ipv4 server max-servers 100
				domain name NCM.com
				domain lookup disable
				taskgroup READ-ONLY-TGRP
				 task read fr
				 task read li
				 task read aaa
				 task read acl
				 task read atm
				 task read bfd
				 task read bgp
				 task read cdp
				 task read cef
				 task read cgn
				 task read eem
				 task read ppp
				 task read qos
				 task read rib
				 task read rip
				 task read sbc
				 task read ancp
				 task read bcdl
				 task read boot
				 task read diag
				 task read dwdm
				 task read hdlc
				 task read hsrp
				 task read ipv4
				 task read ipv6
				 task read isis
				 task read lpts
				 task read ospf
				 task read ouni
				 task read snmp
				 task read vlan
				 task read vrrp
				 task read admin
				 task read eigrp
				 task read l2vpn
				 task read bundle
				 task read crypto
				 task read fabric
				 task read static
				 task read sysmgr
				 task read system
				 task read tunnel
				 task read drivers
				 task read logging
				 task read monitor
				 task read mpls-te
				 task read netflow
				 task read network
				 task read pos-dpt
				 task read firewall
				 task read mpls-ldp
				 task read pkg-mgmt
				 task read fault-mgr
				 task read interface
				 task read inventory
				 task read multicast
				 task read route-map
				 task read sonet-sdh
				 task read transport
				 task read ext-access
				 task read filesystem
				 task read tty-access
				 task read config-mgmt
				 task read ip-services
				 task read mpls-static
				 task read route-policy
				 task read host-services
				 task read basic-services
				 task read config-services
				 task read ethernet-services
				!
				taskgroup READ-WRITE-TGRP
				 inherit taskgroup root-system
				 inherit taskgroup cisco-support
				!
				taskgroup OH-COIN-EBH-TGRP
				 inherit taskgroup netadmin
				 inherit taskgroup operator
				 inherit taskgroup sysadmin
				 inherit taskgroup root-system
				 inherit taskgroup serviceadmin
				 inherit taskgroup cisco-support
				!
				taskgroup READ-WRITE-EBH-TGRP
				 inherit taskgroup root-system
				 inherit taskgroup cisco-support
				!
				usergroup READ-ONLY-UGRP
				 taskgroup READ-ONLY-TGRP
				!
				usergroup READ-WRITE-UGRP
				 taskgroup READ-WRITE-TGRP
				!
				usergroup OH-COIN-EBH-UGRP
				 taskgroup OH-COIN-EBH-TGRP
				!
				usergroup READ-WRITE-EBH-UGRP
				 taskgroup READ-WRITE-EBH-TGRP
				!
				radius source-interface Loopback10 vrf default
				radius-server vsa attribute ignore unknown
				radius-server host 10.195.16.100 auth-port 1645 acct-port 1646
				 key 7 06472A05626F222B2A383A595C5D780A747A
				 timeout 5
				 retransmit 3
				!
				radius-server host 10.215.247.100 auth-port 1645 acct-port 1646
				 key 7 13443236252D2F18040B0061657B41264651
				 timeout 5
				 retransmit 3
				!
				username EBHNCMBB
				 group root-system
				 group cisco-support
				 secret 5 $1$t2f6$3w5cVJvP5MSgluaktm.Nu0
				!
				username EBHNCMSOLK
				 group root-system
				 group cisco-support
				 secret 5 $1$V3W/$aADtgzRUtfA5vR2t9bkQB0
				!
				username njbbcpnebh
				 group root-system
				 group cisco-support
				 secret 5 $1$YEL0$V8AvjQSmtM3WxxRUfeC/p0
				!
				username solkcpnebh
				 group root-system
				 group cisco-support
				 secret 5 $1$uAvV$lP9EJ1AI2Ye0lifGwnB/K0
				!
				username sev1snmpuser
				 password 7 072C365A4418083123471F3D0E
				!
				aaa group server radius radiusgrp
				 server 10.195.16.100 auth-port 1645 acct-port 1646
				 server 10.215.247.100 auth-port 1645 acct-port 1646
				!
				aaa authorization eventmanager default local
				aaa authentication login default local
				aaa authentication login useradius group radiusgrp local
				aaa authentication login console-auth local
				aaa default-taskgroup READ-ONLY-TGRP
				cdp
				vrf LTE
				 description LTE VRF
				 address-family ipv6 unicast
				  import route-target
				   64656:4001
				  !
				  export route-target
				   64656:4001
				  !
				 !
				!
				vrf RAN
				 description EVDO and LTE VRF
				 address-family ipv4 unicast
				  import route-target
				   64656:1000
				  !
				  export route-target
				   64656:1000
				  !
				 !
				!
				vrf 1XRTT
				 description 1XRTT VRF
				 address-family ipv4 unicast
				  import route-target
				   64656:2000
				  !
				  export route-target
				   64656:2000
				  !
				 !
				!
				vrf CELL_MGMT
				 description CELL_MGMT VRF
				 address-family ipv4 unicast
				  import route-target
				   64656:3000
				  !
				  export route-target
				   64656:3000
				  !
				 !
				 address-family ipv6 unicast
				  import route-target
				   64656:3001
				  !
				  export route-target
				   64656:3001
				  !
				 !
				!
				tcp path-mtu-discovery
				line template SSH
				 login authentication useradius
				 exec-timeout 30 0
				 length 30
				 session-timeout 30
				 transport input ssh
				 transport output ssh
				!
				line console
				 password 7 104D000A0618
				 login authentication console-auth
				 timestamp
				 exec-timeout 30 0
				 stopbits 1
				 length 30
				 session-limit 0
				 session-timeout 90
				 transport input ssh telnet
				 transport output ssh telnet
				!
				line default
				 exec-timeout 30 0
				 session-timeout 30
				 transport input ssh telnet
				 transport output ssh telnet
				!
				vty-pool default 0 15 line-template SSH
				snmp-server interface TenGigE0/0/0/3.1002
				 notification linkupdown
				 index persistence
				!
				snmp-server interface TenGigE0/0/0/3.1004
				 notification linkupdown
				 index persistence
				!
				snmp-server interface TenGigE0/0/0/3.1006
				 notification linkupdown
				 index persistence
				!
				snmp-server interface TenGigE0/0/0/3.1008
				 notification linkupdown
				 index persistence
				!
				snmp-server interface TenGigE0/0/0/3.1010
				 notification linkupdown
				 index persistence
				!
				snmp-server interface TenGigE0/0/0/3.1012
				 notification linkupdown
				 index persistence
				!
				snmp-server interface TenGigE0/0/0/3.1014
				 notification linkupdown
				 index persistence
				!
				snmp-server interface TenGigE0/0/0/3.1016
				 notification linkupdown
				 index persistence
				!
				snmp-server interface TenGigE0/0/0/3.1018
				 notification linkupdown
				 index persistence
				!
				snmp-server interface TenGigE0/0/0/3.1020
				 notification linkupdown
				 index persistence
				!
				snmp-server interface TenGigE0/0/0/3.1154
				 notification linkupdown
				 index persistence
				!
				snmp-server ifmib ifalias long
				snmp-server ifindex persist
				snmp-server ifmib stats cache
				snmp-server mibs cbqosmib persist
				snmp-server entityindex persist
				snmp-server engineID local 0024986c0e30
				snmp-server host 10.134.240.5 traps version 2c 2Y2LHTZP31
				snmp-server host 10.134.240.5 traps version 2c cellbackhaul
				snmp-server host 10.194.102.212 traps version 2c 2Y2LHTZP31
				snmp-server host 10.194.102.212 traps version 2c cellbackhaul
				snmp-server host 10.194.236.212 traps version 2c 2Y2LHTZP31
				snmp-server host 10.194.236.212 traps version 2c cellbackhaul
				snmp-server host 2001:4888:a02:2105:a0:fef:0:5 traps version 2c 2Y2LHTZP31
				snmp-server host 2001:4888:a02:2105:a0:fef:0:5 traps version 2c cellbackhaul
				snmp-server user sev1snmpuser sev1group v3 auth md5 encrypted 106D1E0F0F06033F38513E1A2E IPv4 SEV1_ACLv6
				snmp-server view allmibs 1.3.6.1 included
				snmp-server view limited ip included
				snmp-server view limited system included
				snmp-server view limited interfaces included
				snmp-server community 2Y2LHTZP31 RO SystemOwner IPv4 SNMP_ACL
				snmp-server community cellbackhaul RW SystemOwner IPv4 SNMP_ACL
				snmp-server group sev1group v3 auth
				snmp-server queue-length 1000
				snmp-server traps rf
				snmp-server traps ntp
				snmp-server traps ethernet oam events
				snmp-server traps copy-complete
				snmp-server traps snmp
				snmp-server traps flash removal
				snmp-server traps flash insertion
				snmp-server traps config
				snmp-server traps entity
				snmp-server traps syslog
				snmp-server traps ospf errors bad-packet
				snmp-server traps ospf errors authentication-failure
				snmp-server traps ospf errors config-error
				snmp-server traps ospf errors virt-bad-packet
				snmp-server traps ospf errors virt-authentication-failure
				snmp-server traps ospf errors virt-config-error
				snmp-server traps ospf retransmit packets
				snmp-server traps ospf retransmit virt-packets
				snmp-server traps ospf state-change if-state-change
				snmp-server traps ospf state-change neighbor-state-change
				snmp-server traps ospf state-change virtif-state-change
				snmp-server traps ospf state-change virtneighbor-state-change
				snmp-server chassis-id FOX1303GFNY
				snmp-server contact NOC 1-800-242-7622
				snmp-server trap-source Loopback10
				ssrp profile TDM
				 peer ipv4 address 172.25.255.0
				!
				redundancy
				!
				ntp
				 server 10.140.202.2 prefer
				 server 10.140.202.3
				 server 10.208.99.193
				 server 10.208.99.194
				 source Loopback10
				 update-calendar
				!
				tftp client source-interface Loopback10
				ipv4 virtual address 10.140.202.254/24
				ipv6 access-list SEV1_ACLv6
				 10 remark SevOne-NMS-DMZ-Space
				 20 permit ipv6 2001:4888:a02:1d10::/60 any
				 30 permit ipv6 2001:4888:a06:1d50::/60 any
				 40 permit ipv6 2001:4888:a03:1d10::/60 any
				 50 permit ipv6 2001:4888:2:1d10::/60 any
				 60 permit ipv6 2001:4888:6:1d50::/60 any
				 70 permit ipv6 2001:4888:3:1d10::/60 any
				 80 deny ipv6 any any
				!
				ipv6 access-list IPV6-SSM-LTE
				 10 permit ipv6 any ff38::e040:0/116
				!
				ipv4 access-list BFD
				 10 permit udp any any eq 3784
				 20 permit udp any any eq 3785
				!
				ipv4 access-list SNMP_ACL
				 10 remark Version_oneEMSFOA
				 20 permit ipv4 10.132.8.0 0.0.3.255 any
				 30 permit ipv4 10.133.176.0 0.0.2.255 any
				 40 permit ipv4 10.134.168.0 0.0.3.255 any
				 50 permit ipv4 10.134.240.0 0.0.3.255 any
				 60 permit ipv4 10.139.84.0 0.0.1.255 any
				 70 permit ipv4 10.186.4.0 0.0.0.15 any
				 80 permit ipv4 10.186.203.0 0.0.0.15 any
				 90 permit ipv4 10.187.4.0 0.0.3.255 any
				 100 permit ipv4 10.194.102.0 0.0.1.255 any
				 110 permit ipv4 10.194.236.0 0.0.3.255 any
				 120 permit ipv4 10.194.92.0 0.0.3.255 any
				 130 deny ipv4 any any
				!
				ipv4 access-list LOOPBACKS
				 10 permit ipv4 10.114.0.0 0.1.255.255 any
				!
				ipv4 access-list Customer2G
				 10 remark *** Permit VRRP ***
				 20 permit 112 any host 224.0.0.18
				 30 remark *** Block Known Virus and Worm traffic ***
				 40 deny tcp any any eq 135
				 50 deny tcp any any eq 139
				 60 deny tcp any any eq 445
				 70 deny tcp any any eq 1023
				 80 deny tcp any any eq 4444 syn
				 90 deny tcp any any eq 5554 syn
				 100 deny tcp any any eq 9898 syn
				 110 deny udp any any eq 135
				 120 deny udp any any eq netbios-ns
				 130 deny udp any any eq netbios-dgm
				 140 deny udp any gt 1023 any eq 1434
				 150 permit udp 151.144.0.0 0.0.255.255 eq 11000 172.16.0.0 0.3.255.255 eq 11002
				 160 permit icmp 151.144.0.0 0.0.255.255 172.16.0.0 0.3.255.255
				 170 remark *** RFC 1918 compliance ***
				 180 deny ipv4 151.144.0.0 0.0.255.255 10.0.0.0 0.255.255.255
				 190 deny ipv4 166.140.0.0 0.0.255.255 10.0.0.0 0.255.255.255
				 200 deny ipv4 166.145.0.0 0.0.255.255 10.0.0.0 0.255.255.255
				 210 deny ipv4 166.147.0.0 0.0.255.255 10.0.0.0 0.255.255.255
				 220 deny ipv4 166.153.0.0 0.0.255.255 10.0.0.0 0.255.255.255
				 230 deny ipv4 166.180.0.0 0.0.255.255 10.0.0.0 0.255.255.255
				 240 deny ipv4 198.225.0.0 0.0.255.255 10.0.0.0 0.255.255.255
				 250 deny ipv4 199.223.0.0 0.0.255.255 10.0.0.0 0.255.255.255
				 260 deny ipv4 any 172.16.0.0 0.15.255.255
				 270 deny ipv4 any 192.168.0.0 0.0.255.255
				 280 remark *** Allow IWF to WDDF for CALEA ***
				 290 permit ipv4 66.174.0.0 0.0.255.255 host 66.174.81.68
				 300 permit ipv4 66.174.0.0 0.0.255.255 host 66.174.81.69
				 310 permit ipv4 66.174.0.0 0.0.255.255 host 66.174.81.70
				 320 permit ipv4 66.174.0.0 0.0.255.255 host 66.174.87.68
				 330 permit ipv4 66.174.0.0 0.0.255.255 host 66.174.87.69
				 340 permit ipv4 66.174.0.0 0.0.255.255 host 66.174.87.70
				 350 remark *** Allow Pools to reach the VZW DMZ segments ***
				 360 permit ipv4 any 66.174.3.0 0.0.0.255
				 370 permit ipv4 any 66.174.4.0 0.0.0.255
				 380 permit ipv4 any 66.174.6.0 0.0.1.255
				 390 permit ipv4 any 66.174.72.0 0.0.0.255
				 400 permit ipv4 any 66.174.75.0 0.0.0.255
				 410 permit ipv4 any 66.174.76.0 0.0.1.255
				 420 permit ipv4 any 66.174.79.0 0.0.0.255
				 430 permit ipv4 any 66.174.80.0 0.0.0.63
				 440 permit ipv4 any 66.174.82.0 0.0.1.255
				 450 permit ipv4 any 66.174.85.0 0.0.0.255
				 460 permit ipv4 any 66.174.86.0 0.0.1.255
				 470 permit ipv4 any 66.174.90.0 0.0.1.255
				 480 permit ipv4 any 66.174.92.0 0.0.1.255
				 490 permit ipv4 any 66.174.94.0 0.0.1.255
				 500 permit ipv4 any host 66.174.2.16
				 510 permit ipv4 any host 66.174.2.17
				 520 permit ipv4 any host 66.174.2.18
				 530 permit ipv4 any host 66.174.84.18
				 540 

				permit ipv4 any host 66.174.74.43
				 550 deny ipv4 any 69.82.0.0 0.1.255.255
				 560 remark *** Protect VZW infrastructure ***
				 570 deny ipv4 any 66.174.0.0 0.0.255.255
				 580 deny ipv4 any host 199.74.157.17
				 590 deny ipv4 any host 199.74.157.195
				 600 deny ipv4 any host 199.74.157.198
				 610 deny ipv4 any host 199.74.157.214
				 620 remark *** Permit necessary ICMP traffic ***
				 630 permit icmp any any
				 640 remark ** Permit the pools internet access ***
				 650 permit ipv4 any any
				!
				.....

				RP/0/RSP0/CPU0:AKROOH2092A-P-CI-9010-02#
			  </div>

			  <!-- Modal footer -->
			  <div class="modal-footer">
	  			<button type="button" class="btn btn-default">Cancel</button>
				<button type="button" class="btn btn-default">Continue</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>


        <div class="container-fluid">
            <?php include ('menu.php'); ?> 

            <!-- Content Wrapper. Contains page content -->
            <div class="content">
                <!-- Main content -->
                <section class="content"> 
                  <div class="col-md-12">
                      <div class="panel"> 
                          <div class="panel-info">
                            <!-- Page title -->
                          <!--  <div class="panel-heading"> My Devices List </div>
                          </div>                  
						  -->
                          <input type="hidden" id='userid' value="<?php echo $userid ?>" name="">
                          <div class="panel-body">
                            <table id="backuprestore"  class="table table-striped table-sm">
                              <thead>
                                <tr>
                                  <th class="noExport">Health Check</th>
                                  <th>Site Id</th>
                                  <th width="25%">Site Name</th>
                                  <th>Device Name</th>
								  <th>Region</th>
                                  <th>Market  </th>
                                  <th>Device series</th>
                                  <th>Version</th> 
                                </tr>
                              </thead>                              
                            </table>                            
                          </div> 
                        <!-- /.box-body -->
                      </div>
                  </div> 
                </section> <!-- /.content -->
              </div>
            <!-- /.content-wrapper --> 
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <?php include ('footer.php'); ?> 
    </body>
</html>
