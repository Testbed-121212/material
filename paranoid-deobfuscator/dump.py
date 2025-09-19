import os
import re
import json
import base64

# Path to your decoded APK (replace if needed)
APK_PATH = "/home/kali/Documents/material/myapp"

# Regex pattern for chunk strings
CHUNK_PATTERN = re.compile(r'sget-object v\d+, L[^;]+;->CHUNK_\d+:\[B')

def find_chunks(smali_dir):
    chunks = []
    for root, _, files in os.walk(smali_dir):
        for file in files:
            if file.endswith(".smali"):
                path = os.path.join(root, file)
                with open(path, 'r', errors='ignore') as f:
                    content = f.read()
                    if "CHUNK_" in content:
                        chunk_matches = re.findall(r'\.field public static final CHUNK_(\d+): \[B = (.*)', content)
                        for idx, value in chunk_matches:
                            value = value.strip()
                            if value.startswith("L"):
                                continue  # skip unresolved references
                            try:
                                decoded = eval(value)  # decode the byte array
                                b64 = base64.b64encode(bytes(decoded)).decode()
                                chunks.append(b64)
                            except:
                                pass
    return chunks

chunks = find_chunks(APK_PATH)

with open("chunks.json", "w") as f:
    json.dump(chunks, f, indent=2)

print(f"✅ Extracted {len(chunks)} chunks and saved to chunks.json")
