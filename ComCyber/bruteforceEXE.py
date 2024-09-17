import subprocess

def bruteforce_exe(input1, input2, wordlist1, wordlist2):
    # Read the wordlists from files
    with open(wordlist1, 'r') as file1, open(wordlist2, 'r') as file2:
        # Iterate over the lines in the wordlists
        word_counter = 0
        for line1 in file1:
            for line2 in file2:
                # Strip the newline characters
                input1 = line2.strip()
                input2 = line2.strip()
                
                # Run the EXE with the current inputs
                result = subprocess.run(['/home/kzebe/Desktop/Git/CTF-s/ComCyber/m4lw3r3', input1, input2], capture_output=True, text=True)
                
                # Counter for each word used
                # print(f" Testing Inputs: {input1}, {input2} ")
                
                # Increment the counter for each word used
                word_counter += 1

                # Print the current word count
                print(f"Word count: {word_counter}")

                # Check the output of the EXE
                if result.stderr.strip() != "input1 FAILED":
                    print(f"Inputs found: {input1}, {input2}")
                    return

# Example usage
wordlist1 = "/usr/share/wordlists/rockyou.txt"
wordlist2 = "/usr/share/wordlists/rockyou.txt"
input1 = ""
input2 = ""
bruteforce_exe(input1, input2, wordlist1, wordlist2)