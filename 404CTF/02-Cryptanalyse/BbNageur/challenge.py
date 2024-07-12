# from flag import FLAG
import random as rd

charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789{}_-!"

def f(a,b,n,x):
	return (a*x+b)%n

def encrypt(message,a,b,n):
	encrypted = ""
	# print("Encrypted before : " + encrypted)
	for char in message:
		# print("Char : " + char)
		# print("Message : " + message)
		x = charset.index(char)
		print("x before => " + str(x))
		x = f(a,b,n,x)
		print("x after => " + str(x))
		encrypted += charset[x]

	# print("Encrypted after : " + encrypted)
	return encrypted

n = len(charset)
a = rd.randint(2,n-1)
b = rd.randint(1,n-1)


flag = "-4-c57T5fUq9UdO0lOqiMqS4Hy0lqM4ekq-0vqwiNoqzUq5O9tyYoUq2_"

encrypted_flag = "-4-c57T5fUq9UdO0lOqiMqS4Hy0lqM4ekq-0vqwiNoqzUq5O9tyYoUq2_"
charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789{}_-!"

def decrypt(encrypted_flag):
    n = len(charset)
    for a in range(2,n-1):
        for b in range(1,n-1):
            for n in range(len(charset)):
                decrypted_flag = ""
                for char in encrypted_flag:
                    x = charset.index(char)
                    for i in range(len(charset)-1):
                        if (a * i + b)%n == x:
                            decrypted_flag += charset[i]
                            break
                if decrypted_flag.startswith("404ctf{"):
                    return decrypted_flag, a, b, n
    return "Flag not found"

decrypted_flag, a, b, n = decrypt(encrypted_flag)
print("Decrypted flag:", decrypted_flag)
print("a:", a, "b:", b, "n:", n)
# ENCRYPTED FLAG : -4-c57T5fUq9UdO0lOqiMqS4Hy0lqM4ekq-0vqwiNoqzUq5O9tyYoUq2_