import subprocess
import string

class Bruteforce:
    def __init__(self, input1, input2, wordlist):
        self.input1 = input1
        self.input2 = input2
        self.wordlist = wordlist

    def run(self):
        self.bruteforce_recursive("")

    def bruteforce_recursive(self, current_password):
        if self.try_password(current_password):
            print(f"Password found: {current_password}")
            return True

        if len(current_password) >= 5:
            return False
        
        for char in string.ascii_lowercase + string.digits:
            if self.bruteforce_recursive(current_password + char):
                return True
        return False

    def try_password(self, password):
        # Replace 'your_executable' with the actual executable you want to run
        process = subprocess.run(['./m4lw3r3', password, self.input2], capture_output=True, text=True)
        if process.stderr == "input1 FAILED\n":
            print(f"wrong password: {password}")
            print(f" {process.stderr}")
            return False
        else:
            return True

def bruteforce_exe(input1, input2, wordlist):
    bf = Bruteforce(input1, input2, wordlist)
    bf.run()


# Example usage
wordlist1 = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0"]
input1 = ""
input2 = "A"

bruteforce_exe(input1, input2, wordlist1)