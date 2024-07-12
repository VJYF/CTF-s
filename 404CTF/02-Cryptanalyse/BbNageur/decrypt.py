import random as rd
encrypted_flag = "-4-c57T5fUq9UdO0lOqiMqS4Hy0lqM4ekq-0vqwiNoqzUq5O9tyYoUq2_"
charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789{}_-!"

def decrypt(encrypted_flag):
    n = len(charset)
    for a in range(2,n-1):
        for b in range(1,n-1):
            for n in range(n):
                decrypted_flag = ""
                for char in encrypted_flag:
                    x = charset.index(char)
                    for i in range(n):
                        if (a * i + b)%n == x:
                            decrypted_flag += charset[i]
                            break
                if decrypted_flag.startswith("404CTF{"):
                    return decrypted_flag, a, b, n
    return "Flag not found"

decrypted_flag= decrypt(encrypted_flag)
print("Decrypted flag:", decrypted_flag)

# print("a:", a, "b:", b, "n:", n)