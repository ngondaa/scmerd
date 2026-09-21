# Payment Reviewer User Guide

This guide explains how an authorized payment reviewer signs in to the payment-review panel and reviews submitted payment proofs.

## Who should use this guide?

Use this guide if you have been assigned **Payment reviewer access**. Payment reviewers can review payment proofs and approve or reject registrations. This access is separate from the abstract-reviewer dashboard.

> **Important:** Payment reviewers must have an account with **Payment-proof reviewer access** enabled, or administrator access. Standard user accounts and abstract-reviewer accounts cannot sign in to the payment-review panel unless they also have payment-reviewer access.

## Before you begin

Make sure you have:

- The application URL supplied by your conference or system administrator.
- A payment-reviewer account email address.
- The account password.
- Access to a modern web browser.

## Sign in

1. Open the payment-review login page:

   ```text
   https://<your-application-domain>/payment-review/login
   ```

   Replace `<your-application-domain>` with the domain where the application is hosted. For a local installation, this may be similar to `http://localhost:8000/payment-review/login`.

2. Enter your payment-reviewer account email address and password.
3. Submit the form.
4. After a successful login, the payment-review panel opens. If you are already authenticated in another panel, the application still checks that your account is authorized for payment review.

### Access requirements

The account must have either:

- **Payment-proof reviewer access** enabled; or
- **Admin access** enabled.

If you see an authorization error or are returned to the login page, contact an administrator and ask them to verify the account permissions.

## Review payment proofs

After signing in:

1. Open **Payment proofs** from the panel navigation.
2. Review the payment-proof list. The list includes:
   - Registrant name and email
   - Invoice reference
   - Registration package and fee
   - Certificate name
   - ECSA number or student number, when available
   - Uploaded proof of payment
   - Registration status
   - Submission and approval dates
3. Select **View uploaded proof** to open the submitted payment document in a new browser tab.
4. If an invoice reference is available, select **View invoice** to open the registration invoice in a new tab.
5. Use the **Status** filter to focus on a particular status:
   - **Pending review** — payment proof is awaiting review.
   - **Needs review** — the proof was flagged for review.
   - **Approved** — the registration has been marked as paid.
   - **Rejected** — the proof was denied.
6. Compare the uploaded proof with the invoice and the registration details.

## Approve a payment proof

Approve a proof only after confirming that it is valid and matches the registration or invoice details.

1. Find the registrant in **Payment proofs**.
2. Open the uploaded proof and verify the payment information.
3. Select **Accept**.
4. Confirm the action in the confirmation dialog.
5. Verify that the status changes to **Approved**.

Approving a payment proof:

- Marks the registration as paid.
- Records the approval time.
- Sends the payment-approved email notification to the registrant and the configured notification recipients.

## Reject a payment proof

Reject a proof when it is invalid, unreadable, incomplete, or does not match the registration details.

1. Find the registrant in **Payment proofs**.
2. Open and inspect the uploaded proof.
3. Select **Deny**.
4. Confirm the action in the confirmation dialog.
5. Verify that the status changes to **Rejected**.

Rejecting a payment proof removes the paid timestamp and leaves the registration unpaid. Follow your organization’s normal process if the registrant must submit a corrected proof.

## Export payment records

To download a CSV report:

1. Open **Payment proofs**.
2. Select **Export payments**.
3. Save the downloaded CSV file.

The export includes registrant details, invoice and package information, payment status, proof and approval timestamps, and a URL for the uploaded proof file.

Treat exported payment information as confidential and store it only in an approved location.

## Status reference

| Status | Meaning | Recommended action |
| --- | --- | --- |
| Pending review | A payment proof has been submitted and is awaiting review. | Inspect the proof, then accept or deny it. |
| Needs review | The proof requires manual review, including cases flagged for review. | Inspect the proof carefully, then accept or deny it. |
| Approved | The payment was accepted and the registration is marked paid. | No further payment-review action is required. |
| Rejected | The proof was denied and the registration remains unpaid. | Wait for a corrected proof if one is expected. |

## Troubleshooting

### I cannot sign in

- Confirm that you are using the payment-review URL: `/payment-review/login`.
- Confirm that your email address and password are correct.
- Ask an administrator to confirm that **Payment-proof reviewer access** or **Admin access** is enabled for your account.
- If your organization uses two-factor authentication, complete the additional verification step when prompted.

### I can sign in but cannot access payment proofs

Your account may not have the required panel permission. Contact an administrator and ask them to verify the **Payment reviewer status** for your account.

### I do not see a registrant

- Clear any status filter.
- Search or sort the list again.
- Confirm that the registrant has uploaded a payment proof.
- If the proof was already approved or rejected, use the corresponding status filter.

### The proof will not open

- Confirm that the file has finished uploading.
- Try opening it in a new browser tab.
- Contact an administrator if the file link is broken or the document is unreadable.

### I approved or rejected the wrong proof

Stop processing further records and contact an administrator immediately so the payment status can be corrected according to the organization’s process.

## Security and privacy reminders

- Never share your password.
- Do not approve a payment based only on the filename or invoice reference.
- Keep payment proofs and exported CSV files confidential.
- Sign out when using a shared computer.
- Report suspicious or mismatched payment documents to the administrator.

## Administrator setup reference

An administrator can grant access through the admin panel by editing a user and enabling **Payment-proof reviewer access**. Admin access also permits entry to the payment-review panel.

For command-line setup, an administrator can create or update a reviewer account with:

```bash
php artisan app:create-reviewer reviewer@example.com "Reviewer Name" --password='use-a-secure-password'
```

The command creates an account with abstract-reviewer access (`is_reviewer`). To use the payment-review panel, the account must additionally have payment-reviewer access (`is_payment_reviewer`) or admin access. Ask an administrator to enable that permission in the user record.
