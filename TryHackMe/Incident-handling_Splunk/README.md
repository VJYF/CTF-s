# Incident Handling

## Scenario :
- A Big corporate organization Wayne Enterprises has recently faced a cyber-attack where the attackers broke into their network, found their way to their web server, and have successfully defaced their website http://www.imreallynotbatman.com. Their website is now showing the trademark of the attackers with the message YOUR SITE HAS BEEN DEFACED  as shown below.

![defaced](0.Preparation/Cyber_kill_Chain_Model/src/defaced.png)


## Help : 

| Log Sources | Description |
| ----------- | ----------- |
| wineventlog | It contains Windows Event logs|
| winRegistry | It contains the logs related to registry creation / modification / deletion etc. |
| XmlWinEventLog | It contains the sysmon event logs. It is a very important log source from an investigation point of view.|
| fortigate_utm | It contains Fortinet Firewall logs|
| iis | It contains IIS web server logs|
| Nessus:scan | It contains the results from the Nessus vulnerability scanner.|                                                  
| Suricata | It contains the details of the alerts from the Suricata IDS.This log source shows which alert was triggered and what caused the alert to get triggered— a very important log source for the Investigation.                                      
| stream:http |It contains the network flow related to http traffic.|
| stream: DNS | It contains the network flow related to DNS traffic.|
| stream:icmp | It contains the network flow related to icmp traffic.|

>**Note**: All the event logs that we are going to investigate are present in index=botsv1
