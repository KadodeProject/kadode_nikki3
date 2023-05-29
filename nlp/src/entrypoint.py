# リファクタ後の置き場確保用(現状はlegacyにすべて存在)


def entrypoint(char: str) -> str:
    return char * 2


print(entrypoint("test"))
