# リファクタ後の置き場確保用(現状はlegacyにすべて存在)
# 現状はここは使っていない


def entrypoint(char: str) -> str:
    return char * 2


print(entrypoint("test"))
