<?php
$config = array (
		//签名方式,默认为RSA2(RSA2048)
		'sign_type' => "RSA2",

		//支付宝公钥
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA8tkWAkfA/IxdV2bCdXxpyM7BUT/9Bu9Oym2qePRFwvekEyjB3j9H+izU44oIHi4r2PfJ6jtd/C/hLAY2baB+aXi8XnOs1az/28ZGE1ZTRUCFlF8Rxq5RArfPEgFTbnfieJXRrY/WixVUB0gAd8m8xpPpZHLpNR106/IDTpKbr9U30DDvK4qngzd+ypZa750OmRjqI4l1sW5sfmkT6Vjq8aKjv6HHlXG0u58X3vi2TTmSDJ14DyfmsnNIZgqjBiE4kVsOiWs30EBeDW8zlR5BdDYmsCRanpkPZAilYQ5vMB9veYcq33POqUNLDHu1trcl8bIb7nsNyWIROhmXzB2QPwIDAQAB",

		//商户私钥
		'merchant_private_key' => "MIIEpQIBAAKCAQEAwVfNxlFNew4+YMIqBhdcqw9zJmFgCUXpR4L+TVjaZT7rrqUeYL8N9fnkNuiQQu/REzfZR01nmvA2N7ZbLPlTEIwUDU2NgOfPbqbQbeX3xJwLho/XnlWU0vPSm3Gs6ZMAJY4yYbhN742j2sqWjq8X50mO/O1eoFd/O9s9D/eemkKtF1VOjMpzqeEUvnseSiE3ODjd7iM0CuVoDptK6STEVMU/5/S34XBsD9oxDyE1oOV3kC2Q34wZhHyA+xEE6iI0xYrPy6jKEA3j+hJbISYEn66zs1KNygrc4WoZT1KCwQAHI2IpuZ5gSY28OoEF0mLRuE/SR5pm/J1xWef5zc5VVQIDAQABAoIBAQDAqtroMcTgR8VpbpOqFkXGQVMigA7PrtdU5/i64zxfgGAkXW70Qe+Lm0YMYZzA13KlkBX5s+z2vUGKKzKYkqxv5Odmik3kkxxmy90QZwaM6mOh6F2Z7varcUYCmTkSWebfheA2+Q7RFXifYxq9fUZ4uRjAe1q8tfSYlVU4QC3Q0b1fNmL962y+54/KPzRO7ueRFA8YxQ3pN7V+1PEvWv5hfVpF2qGNMSkLjTtMQrsLWIzF/NJ4480/Nps6L3dpHguEpN6/2apxJNjtUT+atw0THI2ZhSxDLg0xgtYGKIJs9LegAHyfRyq0QMtWAF0mjabllIg2Az00j1YAlOzjKegBAoGBAOOFRRfqm7mQZdrwdRG4haTLc5Hw1JiG/8kx6qGh+S/zwSBKK3a8r8C2Fs1KgvyZURkfINXl2Z5B8+UwChCE3rqAB977AMGl2IeVUqVJgm3xYV5O8WYOlAa4+jDBfA2BYgoQqB6Kq802vqWHwOKDF38Nfw0h3jWVULUVdIWUF2fVAoGBANmLVnb/MydgeiYmtgrB21S10rvICwSjP+yTXOqtHjK5jz/DNa5OJtQZV70Koo2Uzo4k/2ak4KpBX7jwMVyRdWIVR5iRVzonstYS9LAakInsx1lZ1P0dJ4cmgilGfGBvnZgkHWsQk7ygZbE9mBh+vsgMIAHtUoANjEJH45agQ3eBAoGBAMm1f1oCvui24fZGtCNvydweG2nJb1GCbgb7YB7IMNmYayGrX/k2s0JQrMp4QsSbUFDLThsUWeh6ZDZObr3Sbnw9wbyoHzWPSPZ7JfgvwZijJUWtC0sFpaqIGBddkhOPH1H5DnN1UXbwD/lE73Zh7lTPrFICMrSimhjQ2qsKbe25AoGBAJSM4W5Atd2ds8t5g7W0yuD9h/lSkLOKBoy11C0sKgLZU0hnNLDiDQGojJE6QeYMR0ApY33j+MZJ/eN7oTlk2pMvlMRJ+xZrJWOpbg0TFsAYP8hz3004K1XOpfMpfqUbkrHhd3U0zK1xmf993+5aHkzcer7WIA/xMGXSUUb6CRgBAoGAeh/xzK4AcFdqcs1pZ7HeST0+OFE3cj5lkcY+C8VdtE2+j9LJt4ZNGLjU14MnTW201+k5/r36hIfLP3QjzFY9rOnL4jXNtD6T1juWdfF+srZHi2SK5UkMfeQ76nPzkTJ69YN/Qd+TfFx/5IVzoPBp88sn9PtuFrWR21CDa+karno=",

		//编码格式
		'charset' => "UTF-8",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

		//应用ID
		'app_id' => "2018022802286693",

		//异步通知地址,只有扫码支付预下单可用
		'notify_url' => "http://www.baidu.com",

		//最大查询重试次数
		'MaxQueryRetry' => "10",

		//查询间隔
		'QueryDuration' => "3"
);