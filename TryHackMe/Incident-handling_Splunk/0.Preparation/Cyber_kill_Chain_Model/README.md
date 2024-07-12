# Cyber kill Chain Model
## 1. Reconnaissance
- **Web Server** : imreallynotbatman.com
    1. Search Query : `index=botsv1 imreallynotbatman.com`
    >**Show all logs entries of the webserver**
    *We are going to look for the event logs in the index "botsv1" which contains the term imreallynotbatman.com.*

    2. Search Query : `index=botsv1 imreallynotbatman.com sourcetype=stream:http`
    >**Show all http traffic** 
    *This query will only look for the term imreallynotbatman.com in the stream:http log source.*

    3. SouceIP finds :

    | IP | Nb Events | % |
    |-----|--------|------|
    | 40.80.148.42 | 17483 | 93,402 |
    | 23.22.63.114 | 1235 | 6,598 |

- **IP** : `40.80.124.42`
    1. Search Query : `index=botsv1 imreallynotbatman.com sourcetype=stream:http src_ip="40.80.148.42"`
    >**Show all information like User-Agent, Post request, URIs, etc. of the requested source ip**
    *We are going to look for the event logs in the index "botsv1" which contains the term imreallynotbatman.com. in the stream:http source logs with the ip requested*

    2. Search Query : `index=botsv1 imreallynotbatman.com src=40.80.148.42 sourcetype=suricata`
    >**Show Suricata logs for the Src_IP (Users IP) requested**  
    *This query will show the logs from the suricata log source that are detected/generated from the source IP 40.80.248.42*

## 2. Weaponize

## 3. Delivery

## 4. Exploitation
##### Notes : 
> - We found two IP addresses from the reconnaissance phase with sending requests to our server.
> - One of the IPs 40.80.148.42 was seen attempting to scan the server with IP 192.168.250.70.
> - The attacker was using the web scanner Acunetix for the scanning attempt.


- **Web Server** : 
    1. Search Query : `index=botsv1 imreallynotbatman.com sourcetype=stream* | stats count(src_ip) as Requests by src_ip | sort - Requests`
    >**Show SourceIP % of requests**
    *This query uses the stats function to display the count of the IP addresses in the field src_ip*

    2. Search Query :  `index=botsv1 sourcetype=stream:http dest_ip="192.168.250.70"`
        1. We can add `http_method=` for filtring by request methods (POST, PUT, GET, ... )
        2. Interesting fields : 
        3. Found uri : `joomla/administrator/index.php`
    >**show all HTTP traffic of Dest_IP (WebServer IP)**
    *This query will look for all the inbound traffic towards IP 192.168.250.70*


    | IP | details |
    |-----|--------|
    | src_ip | User IP of the request | 
    | form_data | Form content of the request  | 
    | http_user_agent | User-Agent of the User request |
    | uri | URL of endpoints |
        
- **URI :**
    1. Search Query : `index=botsv1 imreallynotbatman.com sourcetype=stream:http dest_ip="192.168.250.70"  uri="/joomla/administrator/index.php"`
    >**Show traffic coming into the URI requested**
    *We are going to add uri="/joomla/administrator/index.php" in the search query to show the traffic coming into this URI* 

    2. Search Query : `index=botsv1 sourcetype=stream:http dest_ip="192.168.250.70" http_method=POST uri="/joomla/administrator/index.php" | table _time uri src_ip dest_ip form_data`
    >**Show content of the form_data**
    *We will add this -> | table _time uri src_ip dest_ip form_data to create a table containing important fields as shown below*

    3. Search Query : `index=botsv1 sourcetype=stream:http dest_ip="192.168.250.70" http_method=POST uri="/joomla/administrator/index.php" form_data=*username*passwd* | table _time uri src_ip dest_ip form_data`
    >**Search Username and Password in `form_data`**
    *We can display only the logs that contain the username and passwd values in the form_data field by adding `form_data=*username*passwd*` in the above search.*

    4. Search Query : `ndex=botsv1 sourcetype=stream:http dest_ip="192.168.250.70" http_method=POST form_data=*username*passwd* | rex field=form_data "passwd=(?<creds>\w+)"  | table src_ip creds`
    >**Extract Username and Password using Regex**
    *This will pick the `form_data` field and extract all the values found with the field. `creds.`*

    5. Search Query : `index=botsv1 sourcetype=stream:http dest_ip="192.168.250.70" http_method=POST form_data=*username*passwd* | rex field=form_data "passwd=(?<creds>\w+)" |table _time src_ip uri http_user_agent creds`
    >**Display key fields and values**
    *add `http_user_agent` a field in the search head.*

## 5. Installation

- **.exe**
    1. Search Query : `index=botsv1 sourcetype=stream:http dest_ip="192.168.250.70" *.exe`
    >**Show all http traffic containing the term .exe**
    *With the search query in place, we are looking for the fields that could have some values of our interest. As we could not find the file name field, we looked at the missing fields and saw a field. `part_filename{}`*
    
## 6. Command & Control

## 7. Actions on Objectives

