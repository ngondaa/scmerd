# Production email deliverability

Application changes improve the content and trust signals of account emails, but inbox placement is decided by receiving mail providers. Complete this checklist before sending production verification emails.

## 1. Use one aligned sender identity

Set a branded display name and send only from a mailbox at the same domain that is authenticated by your SMTP provider. Do not use a personal Gmail/Outlook address in `MAIL_FROM_ADDRESS`.

```dotenv
MAIL_FROM_ADDRESS="noreply@scmerd.org"
MAIL_FROM_NAME="Central Branch Conference"
MAIL_REPLY_TO_ADDRESS="support@scmerd.org"
MAIL_REPLY_TO_NAME="Central Branch Conference Support"
```

`MAIL_REPLY_TO_ADDRESS` must be a real, monitored mailbox. If `noreply@scmerd.org` is used, its domain must be the domain that passes SPF or DKIM alignment.

## 2. Authenticate the sending domain in DNS

In the DNS zone for the domain in `MAIL_FROM_ADDRESS`, publish the records supplied by the SMTP provider:

1. **SPF:** one TXT record authorising every service that sends mail for the domain. Merge provider instructions into the existing SPF record; never create multiple SPF TXT records.
2. **DKIM:** enable signing in the SMTP provider and publish its selector record. Prefer a 2048-bit key where the provider supports it.
3. **DMARC:** begin with monitoring, then move to enforcement only after reports show all legitimate senders pass.

```dns
_dmarc.scmerd.org. TXT "v=DMARC1; p=none; rua=mailto:dmarc-reports@scmerd.org; adkim=s; aspf=s; pct=100"
```

The SPF and DKIM values are provider-specific—copy the exact values from the provider rather than using an invented `include:` value. The domain in the visible `From:` address must align with the SPF or DKIM authenticated domain.

## 3. Ensure the SMTP server identifies itself correctly

The SMTP server's public IP needs a PTR record that resolves to a hostname, and that hostname needs an A/AAAA record resolving back to the same IP. Set `MAIL_EHLO_DOMAIN` to that hostname, for example:

```dotenv
MAIL_EHLO_DOMAIN="mail.scmerd.org"
```

Only use this example after confirming the forward and reverse records match. Ask the SMTP host to fix PTR/rDNS if they do not.

## 4. Verify before launch

Send one verification email each to Gmail, Outlook, and Yahoo. In each mailbox, use **Show original / View message source** and confirm `SPF=PASS`, `DKIM=PASS`, and `DMARC=PASS`, with the aligned `From:` domain. Do this after every SMTP or DNS change and monitor the DMARC aggregate-report mailbox.

Keep account emails transactional: use a stable From address, no marketing copy or link tracking, and send only after a user action. The app's verification emails already follow this pattern.
