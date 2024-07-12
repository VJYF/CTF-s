# Anonforce

# TARGET
IP: 10.10.92.200

# SCAN
## Open ports
- 21/ FTP
- 22/ SSH

## NMAP scan
NMAP scan -> ./NetScan.txt

# FTP EXPLORE
## Founded Files
- ./ftp/backup.gpg
- ./ftp/private.asc
- ./ftp/user.txt

## Hash (GPG2JOHN)
- ftp/hash

## GPG (GPG --decrypt)
### root hash
root:$6$07nYFaYf$F4VMaegmz7dKjsTukBLh6cP01iMmL7CiQDt1ycIm6a.bsOIBp0DwXVb9XI2EtULXJzBtaMZMNd2tV4uob5RVM0:18120:0:99999:7:::

## John 
- ./newHash